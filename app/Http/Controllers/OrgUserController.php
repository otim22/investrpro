<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OrgUserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $users = User::where('company_name', $user->company_name)->get();
        return view('account.user_creation.index', compact('users'));
    }
    
    public function create()
    {
        $user = Auth::user();
        $users = User::where('company_name', $user->company_name)->get();
        return view('account.user_creation.create', compact('users'));
    }
   
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required','string','max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company_name' => Auth::user()->company->company_name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]); 
        $user->assignRole('Ordinary Member');

        $request->session()->flash('success', 'User created successfully');
        return redirect()->route('org.user.index');
    }
     
    public function show(User $user)
    {
        $authUser = Auth::user();
        $users = User::where('company_name', $authUser->company_name)->get();
        return view('account.user_creation.show', compact(['users', 'user']));
    }
     
    public function edit(User $user)
    {
        $authUser = Auth::user();
        $users = User::where('company_name', $authUser->company_name)->get();
        return view('account.user_creation.edit', compact(['users', 'user']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
        ]);
        $user->fill([
            'first_name' => $request->first_name, 
            'last_name' => $request->last_name,
            'email' => $request->email,
        ])->save();

        return redirect()->route('org.user.index', $user)->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('org.user.index')->with('success', 'User deleted successfully');
    }
}
