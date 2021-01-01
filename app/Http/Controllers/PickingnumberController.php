<?php

namespace App\Http\Controllers;

use App\Models\Pickingnumber;
use App\Models\User;
use Illuminate\Http\Request;

class PickingnumberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pickingnumbers = auth()->user()->pickingnumber()->with(['season', 'farmer'])->get()->toArray();

        return view('pickingnumbers.index', compact(['pickingnumbers']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $seasons = auth()->user()->season()->latest()->pluck('name', 'id');
        $farmers = User::where('user_id', auth()->user()->id)
        ->where('role_id', User::ROLES['FARMER'])
        ->latest()
        ->pluck('name', 'id');

        return view('pickingnumbers.create', compact(['seasons', 'farmers']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'season_id' => 'required',
            'farmer_id' => 'required',
            'title' => 'required',
            'sell_per_kg' => 'required',
            'labour_pay_per_kg' => 'required',
        ]);

        auth()->user()->pickingnumber()->create($data);

        return redirect()->route('pickingnumbers.index')->with('success', 'Added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Pickingnumber $pickingnumber)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Pickingnumber $pickingnumber)
    {
        $seasons = auth()->user()->season()->latest()->pluck('name', 'id');
        $farmers = User::where('user_id', auth()->user()->id)
        ->where('role_id', User::ROLES['FARMER'])
        ->latest()
        ->pluck('name', 'id');

        return view('pickingnumbers.edit', compact(['pickingnumber', 'seasons', 'farmers']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pickingnumber $pickingnumber)
    {
        $data = request()->validate([
            'season_id' => 'required',
            'farmer_id' => 'required',
            'title' => 'required',
            'sell_per_kg' => 'required',
            'labour_pay_per_kg' => 'required',
        ]);

        $pickingnumber->update($data);

        return redirect()->route('pickingnumbers.index')->with('success', 'Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pickingnumber $pickingnumber)
    {
    }
}
