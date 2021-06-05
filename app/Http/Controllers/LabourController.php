<?php

namespace App\Http\Controllers;

use App\Models\User;
use Faker\Factory as FakerFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LabourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labours = User::where('user_id', auth()->user()->id)
            ->where('role_id', User::ROLES['LABOUR'])
            ->get()
            ->toArray();

        return view('labours.index', compact(['labours']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('labours.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'name' => 'required',
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        $faker = FakerFactory::create();

        User::create([
            'role_id' => User::ROLES['LABOUR'],
            'user_id' => auth()->user()->id,
            'name' => $data['name'],
            'email' => $faker->unique()->safeEmail,
            'password' => Hash::make('password'),
        ]);

        return redirect()->route('labours.index')->with('success', 'Added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $labour)
    {
        return view('labours.edit', compact(['labour']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $labour)
    {
        $data = request()->validate([
            'name' => 'required',
        ]);

        $labour->update($data);

        return redirect()->route('labours.index')->with('success', 'Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
