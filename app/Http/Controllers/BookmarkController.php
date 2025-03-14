<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\AnimeLists;

class BookmarkController extends Controller
{
    public function updateAnimeList(Request $request)
    {
        Log::info('Request received:', $request->all());
        $this->validateRequest($request);
        if (!$this->isUserAuthenticated()) {
            return $this->unauthenticatedResponse();
        }

        $user = $this->getAuthenticatedUser();

        $this->updateAnimeListStatus($user, $request);

        return response()->json(['success' => true, 'message' => 'Anime list updated successfully']);
    }
    public function getCurrentStatus($mal_id)
    {
        $user = Auth::user();

        if (!$user instanceof User) {
            return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
        }

        $anime = AnimeLists::where('user_id', $user->id)
                            ->where('mal_id', $mal_id)
                            ->first();

        $status = $anime ? $anime->status : 'unwatched';

        return response()->json(['success' => true, 'status' => $status]);
    }
    private function validateRequest(Request $request)
    {
        $request->validate(['mal_id' => 'required|integer', 'status' => 'required|string|in:liked,plan_to_watch,currently_watching,disliked,wont_watch,unwatched']);
    }
    private function isUserAuthenticated()
    {
        $isAuthenticated = Auth::check();
        return $isAuthenticated;
    }
    private function unauthenticatedResponse()
    {
        Log::error('User not authenticated');
        return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
    }
    private function getAuthenticatedUser()
    {
        $userId= User::find(Auth::id());
        return $userId;
    }


    private function updateAnimeListStatus(User $user, Request $request)
    {
        if ($request->status === 'unwatched') {
            return $this->removeAnimeFromList($user, $request->mal_id);
        } else {
            return $this->updateOrAddAnimeStatus($user, $request->mal_id, $request->status);
        }
    }
    private function removeAnimeFromList(User $user, $mal_id)
    {
        return AnimeLists::where('user_id', $user->id)
        ->where('mal_id', $mal_id)
        ->delete();
    }
    private function updateOrAddAnimeStatus(User $user, $mal_id, $status)
    {
        AnimeLists::updateOrCreate(
            ['user_id' => $user->id, 'mal_id' => $mal_id], // Conditions to find the record
            ['status' => $status] // Data to update or create
        );
    }


}
