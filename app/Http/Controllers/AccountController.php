<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class AccountController extends Controller
{
    //
    public function edit(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            'username' => 'string|min:5',
            //'email' => 'string|email|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . Auth::id(),
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
        ]);

        $profilePicPath = Auth::user()->profile_pic;
        if ($request->hasFile('profile_pic')) {
            $profilePicName = time() . '.' . $request->file('profile_pic')->getClientOriginalExtension();
            $request->file('profile_pic')->move(public_path('profile_pics'), $profilePicName);
            $profilePicPath = 'profile_pics/' . $profilePicName;
        }

        User::where('id', $userId)->update([
            'email' => $request->email,
            'name' => $request->username,
            'profile_pic' => $profilePicPath
        ]);

        return redirect()->back();
    }
}
