<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\AnimeLists;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function account_info()
    {
        $user = Auth::user();

        $statusCounts = [
            'liked' => 0,
            'plan_to_watch' => 0,
            'currently_watching' => 0,
            'disliked' => 0,
            'wont_watch' => 0,
        ];
        $totalCount = 0;

        if ($user) {
            // Fetch the anime list from the anime_lists table for the authenticated user
            $animeList = AnimeLists::where('user_id', $user->id)->get();

            foreach ($animeList as $anime) {
                if (isset($anime->status)) {
                    $status = $anime->status;
                    $totalCount++;

                    if (array_key_exists($status, $statusCounts)) {
                        $statusCounts[$status]++;
                    }
                }
            }
        }

        return view('account-info', [
            'title' => 'Account Information',
            'statusCounts' => $statusCounts,
            'totalCount' => $totalCount
        ]);
    }

    public function edit(Request $request)
    {
        $this->validateRequest($request);

        $userId = Auth::id();
        $profilePicPath = Auth::user()->profile_pic;

        if ($request->hasFile('profile_pic')) {
            if ($request->file('profile_pic')->getSize() > 4096 * 1024) {
                return redirect()->back()->withErrors(['profile_pic' => 'The profile picture must not be larger than 4 MB.']);
            }

            $profilePicName = time() . '.' . $request->file('profile_pic')->getClientOriginalExtension();
            $request->file('profile_pic')->move(public_path('profile_pics'), $profilePicName);
            $profilePicPath = 'profile_pics/' . $profilePicName;
        }

        User::where('id', $userId)->update([
            'email' => $request->email,
            'name' => $request->username,
            'profile_pic' => $profilePicPath
        ]);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'username' => 'string|min:5',
            'email' => 'string|email|max:255|unique:users,email,' . Auth::id(),
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
        ]);
    }
}
