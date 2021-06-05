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
        $pickingnumbers = auth()->user()->pickingnumber()->with(['farmer'])->latest()->get()->toArray();

        return view('pickingnumbers.index', compact(['pickingnumbers']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $farmers = User::where('user_id', auth()->user()->id)
            ->where('role_id', User::ROLES['FARMER'])
            ->latest()
            ->pluck('name', 'id');

        return view('pickingnumbers.create', compact(['farmers']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'farmer_id' => 'required',
            'title' => 'required',
            'sell_per_kg' => 'nullable|numeric|min:0',
            'labour_pay_per_kg' => 'required|numeric|min:0',
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
        $farmers = User::where('user_id', auth()->user()->id)
            ->where('role_id', User::ROLES['FARMER'])
            ->latest()
            ->pluck('name', 'id');

        return view('pickingnumbers.edit', compact(['pickingnumber', 'farmers']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pickingnumber $pickingnumber)
    {
        $data = request()->validate([
            'farmer_id' => 'required',
            'title' => 'required',
            'sell_per_kg' => 'nullable|numeric|min:0',
            'labour_pay_per_kg' => 'required|numeric|min:0',
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
