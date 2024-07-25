<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = User::role('member')->latest()->paginate(10);
        return view('members.index', compact("members"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest   $request)
    {
        User::create($request->all())->assignRole('member');
        return redirect()->route('members')->with('success', 'Berhasil menambah anggota baru.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $anggota)
    {
        $anggota->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
        ]);
        return redirect()->route('members')->with('success', 'Berhasil mengubah data anggota.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
