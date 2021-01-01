<?php

namespace App\Http\Controllers;

use App\Models\Picking;
use App\Models\Pickingnumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PickingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pickingnumber = Pickingnumber::with(['season', 'farmer'])->findOrFail(request()->id)->toArray();

        $pickings = Picking::with('labour')->where('pickingnumber_id', request()->id)->get()->toArray();
        $pickings_by_labour = collect($pickings)->groupBy('labour_id');

        $picking_dates = Picking::select([
            DB::raw('date'),
            DB::raw('sum(kgs_picked) as daily_total'),
        ])
        ->where('pickingnumber_id', request()->id)->groupBy('date')->pluck('daily_total', 'date');

        return view('pickings.index', compact(['pickings_by_labour', 'picking_dates', 'pickingnumber']));
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
    public function edit(Picking $picking)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Picking $picking)
    {
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
