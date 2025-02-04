<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    //
    public function register(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'username' => 'required|string|min:5',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
        ]);

        // Check if the email already exists in the database
        $existingUser  = User::where('email', $request->email)->first();
        if ($existingUser ) {
            // If the email exists, redirect back with an error message
            return redirect()->back()->withErrors(['email' => 'The email has already been taken.'])->withInput();
        }

        // Handle profile picture upload
        $profilePicPath = null;
        if ($request->hasFile('profile_pic')) {
            $profilePicName = time() . '.' . $request->file('profile_pic')->getClientOriginalExtension();
            $request->file('profile_pic')->move(public_path('profile_pics'), $profilePicName);
            $profilePicPath = 'profile_pics/' . $profilePicName;
        }

        // Create the new user
        User::create([
            'email' => $request->email,
            'name' => $request->username,
            'password' => Hash::make($request->password),
            'profile_pic' => $profilePicPath
        ]);

        return redirect()->back()->with('success', 'Account has been created!');

    }
}
