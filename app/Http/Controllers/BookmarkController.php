<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Import the Log facade
use App\Models\User;

class BookmarkController extends Controller
{
    public function updateAnimeList(Request $request)
    {
        Log::info('Request received:', $request->all());

        $request->validate([
            'mal_id' => 'required|integer',
            'status' => 'required|string|in:liked,plan_to_watch,currently_watching,disliked,wont_watch,unwatched'
        ]);

        if (!Auth::check()) {
            Log::error('User  not authenticated');
            return response()->json(['success' => false, 'message' => 'User  not authenticated'], 401);
        }

        $userId = Auth::id();
        $user = User::find($userId);

        if (!$user) {
            Log::error('User  not found', ['userId' => $userId]);
            return response()->json(['success' => false, 'message' => 'User  not found'], 404);
        }

        $animeList = is_string($user->anime_list) ? json_decode($user->anime_list, true) : ($user->anime_list ?? []);

        if (!is_array($animeList)) {
            Log::error('Anime list is not an array', ['anime_list' => $user->anime_list]);
            return response()->json(['success' => false, 'message' => 'Invalid anime list format'], 500);
        }

        // Check if the status is "unwatched"
        if ($request->status === 'unwatched') {
            // Remove the anime from the list
            $animeList = array_filter($animeList, function ($anime) use ($request) {
                return $anime['mal_id'] !== $request->mal_id;
            });
        } else {
            // Update the status of the anime
            $found = false;
            foreach ($animeList as &$anime) {
                if (isset($anime['mal_id']) && $anime['mal_id'] == $request->mal_id) {
                    $anime['status'] = $request->status;
                    $found = true;
                    break;
                }
            }

            // If not found, add it to the list
            if (!$found) {
                $animeList[] = ['mal_id' => $request->mal_id, 'status' => $request->status];
            }
        }

        // Update the user's anime list
        $user->anime_list = $animeList;

        try {
            $user->save();
        } catch (\Exception $e) {
            Log::error('Error saving user anime list', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Failed to update anime list.'], 500);
        }

        return response()->json(['success' => true, 'message' => 'Anime list updated successfully']);
    }

    public function getCurrentStatus($mal_id)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User  not authenticated'], 401);
        }

        $animeList = is_string($user->anime_list) ? json_decode($user->anime_list, true) : $user->anime_list;

        if (!is_array($animeList)) {
            Log::error('Anime list is not an array', ['anime_list' => $user->anime_list]);
            return response()->json(['success' => false, 'message' => 'Invalid anime list format'], 500);
        }

        foreach ($animeList as $anime) {
            if ($anime['mal_id'] == $mal_id) {
                return response()->json(['success' => true, 'status' => $anime['status']]);
            }
        }

        return response()->json(['success' => true, 'status' => 'default']);
    }
}
