<?php

namespace App\Http\Controllers;

use App\Models\User;
use Faker\Factory as FakerFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FarmerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $farmers = User::where('user_id', auth()->user()->id)
            ->where('role_id', User::ROLES['FARMER'])
            ->get()
            ->toArray();

        return view('farmers.index', compact(['farmers']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('farmers.create');
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
            'role_id' => User::ROLES['FARMER'],
            'user_id' => auth()->user()->id,
            'name' => $data['name'],
            'email' => $faker->unique()->safeEmail,
            'password' => Hash::make('password'),
        ]);

        return redirect()->route('farmers.index')->with('success', 'Added successfully!');
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
    public function edit(User $farmer)
    {
        return view('farmers.edit', compact(['farmer']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $farmer)
    {
        $data = request()->validate([
            'name' => 'required',
        ]);

        $farmer->update($data);

        return redirect()->route('farmers.index')->with('success', 'Updated successfully!');
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
