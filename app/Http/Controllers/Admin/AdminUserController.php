<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('Admin.user', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.user.form-tambah',);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            // 'phone_number' => 'string',
            // 'address' => ['string', 'max:255'],
            'password' => ['required', Password::defaults()],
        ]);
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                // 'phone_number' => $request->phone_number,
                // 'address' => $request->address,
                'role' => $request->role ?? 0,
                'password' => Hash::make($request->password),
            ]);

            event(new Registered($user));

            return redirect()->route('admin.user')->with('success', $user->name . ', Registered successfully');
        } catch (Exception $e) {
            return redirect()->route('admin.user.create')->with('error', $e)->getMessage();
        }
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}