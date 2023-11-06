<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function updateName(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
        ]);
        $user->fill([
            'first_name' => $request->first_name, 
            'last_name' => $request->last_name,
        ])->save();
        return redirect()->route('profile')->with("success", "$user->first_name updated successfully!");
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'new_password' => ['required', 'confirmed', 'string', 'min:8', 'different:password'],
        ]);
        $user = Auth::user();
        if (Hash::check($request->password, $user->password)) { 
            $user->fill([
                'password' => Hash::make($request->new_password)
            ])->save();

            $request->session()->flash('success', 'Password changed');
            return redirect()->route('profile');
        } else {
            $request->session()->flash('error', 'Password does not match');
            return redirect()->route('profile');
        }
    }
}