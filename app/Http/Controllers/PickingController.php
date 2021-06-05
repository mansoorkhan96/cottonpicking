<?php

namespace App\Http\Controllers;

use App\Models\Picking;
use App\Models\Pickingnumber;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PickingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pickingnumber = Pickingnumber::with(['farmer'])
            ->findOrFail(request()->id)
            ->toArray();

        $sql = 'SELECT labour_id, name
            FROM pickings
            JOIN users on users.id = pickings.labour_id AND users.is_active = 1
            WHERE pickingnumber_id = '.request()->id.' AND date IN (SELECT MAX(date) FROM pickings)';

        $current_picking_labour = DB::select($sql);

        $current_picking_labour_ids = array_map(function ($item) {
            return $item->labour_id;
        }, $current_picking_labour);

        $other_labour = User::active()
            ->where('role_id', User::ROLES['LABOUR'])
            ->whereNotIn('id', $current_picking_labour_ids)
            ->select('name', 'id')
            ->get()
            ->toArray();

        $picking_dates = Picking::select([
                DB::raw('date'),
                DB::raw('sum(kgs_picked) as daily_total'),
            ])
            ->where('pickingnumber_id', request()->id)
            ->groupBy('date')
            ->pluck('daily_total', 'date')
            ->toArray();

        $sql = 'SELECT *';
        foreach ($picking_dates as $date => $item) {
            $chunks[] = "SUM(if(date = '$date',kgs_picked,0)) as '$date'";
        }
        $sql_parts = implode(', ', $chunks ?? []);
        $sql .= $sql_parts !== '' ? ", $sql_parts" : '';
        $sql .= ' FROM pickings JOIN users on users.id = pickings.labour_id WHERE pickingnumber_id = '.request()->id.' GROUP BY labour_id';

        $pickings = DB::select($sql);

        return view('pickings.index', compact(['picking_dates', 'pickingnumber', 'pickings', 'current_picking_labour', 'other_labour']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'pickingnumber_id' => Rule::unique('pickings')->where(function ($query) use ($request) {
                return $query->where('pickingnumber_id', $request->pickingnumber_id)
                    ->where('date', $request->date)
                    ->whereIn('labour_id', array_keys($request->kgs_picked));
            }),
            'date' => ['required'],
            'kgs_picked' => ['required', 'array'],
            'kgs_picked.*' => ['required', 'numeric', 'min:0'],
        ]);

        $pickings = [];
        foreach (request()->kgs_picked as $key => $item) {
            $pickings[] = [
                'pickingnumber_id' => $data['pickingnumber_id'],
                'date' => $data['date'],
                'labour_id' => $key,
                'kgs_picked' => $item,
            ];
        }

        DB::table('pickings')->insert($pickings);

        return redirect()->route('pickings.index', ['id' => $data['pickingnumber_id']])->with('success', 'Added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Picking $picking)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($pickingnumber_id)
    {
        $date = request()->date;

        $sql = "SELECT *, SUM(if(date = '$date',kgs_picked,0)) as '$date' FROM pickings JOIN users on users.id = pickings.labour_id WHERE pickingnumber_id = $pickingnumber_id AND pickings.date = '$date' GROUP BY labour_id";
        $pickings = DB::select($sql);

        $current_picking_labour_ids = array_map(function ($item) {
            return $item->labour_id;
        }, $pickings);

        $other_labour = User::active()
            ->where('role_id', User::ROLES['LABOUR'])
            ->whereNotIn('id', $current_picking_labour_ids)
            ->select('name', 'id')
            ->get()
            ->toArray();

        return view('pickings.edit', compact(['pickingnumber_id', 'date', 'pickings', 'other_labour']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pickingnumber_id)
    {
        request()->validate([
            'date' => ['required'],
            'kgs_picked' => ['required', 'array'],
            'kgs_picked.*' => ['required', 'numeric', 'min:0'],
        ]);

        foreach (request()->kgs_picked as $key => $item) {
            Picking::updateOrCreate(
                ['pickingnumber_id' => $pickingnumber_id, 'date' => request()->date, 'labour_id' => $key],
                ['kgs_picked' => $item]
            );
        }

        return redirect()->route('pickings.index', ['id' => $pickingnumber_id])->with('success', 'Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Picking $picking)
    {
    }
}
