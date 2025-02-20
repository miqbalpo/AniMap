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
        if (!$user) {
            return $this->userNotFoundResponse();
        }
        $animeList = $this->getAnimeList($user);
        if (!is_array($animeList)) {
            return $this->invalidAnimeListResponse($user);
        }
        $animeList = $this->updateAnimeListStatus($animeList, $request);
        $user->anime_list = $animeList;

        return response()->json(['success' => true, 'message' => 'Anime list updated successfully']);
    }
    public function getCurrentStatus($mal_id)
    {
        $user = Auth::user();
        if (!$user instanceof User) {
            return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
        }
        $animeList = $this->getAnimeList($user);
        if (!is_array($animeList)) {
            Log::error('Anime list is not an array', ['anime_list' => $user->anime_list]);
            return response()->json(['success' => false, 'message' => 'Invalid anime list format'], 500);
        }
        $status = $this->findAnimeStatus($animeList, $mal_id);
        return response()->json(['success' => true, 'status' => $status]);
    }
    private function validateRequest(Request $request)
    {
        $request->validate(['mal_id' => 'required|integer', 'status' => 'required|string|in:liked,plan_to_watch,currently_watching,disliked,wont_watch,unwatched']);
    }
    private function isUserAuthenticated()
    {
        return Auth::check();
    }
    private function unauthenticatedResponse()
    {
        Log::error('User not authenticated');
        return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
    }
    private function getAuthenticatedUser()
    {
        $userId = Auth::id();
        return User::find($userId);
    }
    private function userNotFoundResponse()
    {
        $userId = Auth::id();
        Log::error('User not found', ['userId' => $userId]);
        return response()->json(['success' => false, 'message' => 'User not found'], 404);
    }
    private function getAnimeList(User $user)
    {
        // Fetch the anime list from the anime_lists table for the authenticated user
        return AnimeLists::where('user_id', $user->id)->get()->toArray();
    }
    private function invalidAnimeListResponse(User $user)
    {
        Log::error('Anime list is not an array', ['anime_list' => $user->anime_list]);
        return response()->json(['success' => false, 'message' => 'Invalid anime list format'], 500);
    }
    private function updateAnimeListStatus(array $animeList, Request $request)
    {
        if ($request->status === 'unwatched') {
            return $this->removeAnimeFromList($animeList, $request->mal_id);
        } else {
            return $this->updateOrAddAnimeStatus($animeList, $request->mal_id, $request->status);
        }
    }
    private function removeAnimeFromList(array $animeList, $mal_id)
    {
        return array_filter($animeList, function ($anime) use ($mal_id) {
            return $anime['mal_id'] !== $mal_id;
        });
    }
    private function updateOrAddAnimeStatus(array $animeList, $mal_id, $status)
    {
        $existingAnime = AnimeLists::where('user_id', Auth::id())->where('mal_id', $mal_id)->first();
        if ($existingAnime) {
            $existingAnime->update(['status' => $status]);
        } else {
            AnimeLists::create(['user_id' => Auth::id(), 'mal_id' => $mal_id, 'status' => $status,]);
        }
        $found = false;
        foreach ($animeList as &$anime) {
            if (isset($anime['mal_id']) && $anime['mal_id'] == $mal_id) {
                $anime['status'] = $status;
                $found = true;
                break;
            }
        }
        if (!$found) {
            $animeList[] = ['mal_id' => $mal_id, 'status' => $status];
        }
        return $animeList;
    }
    private function saveErrorResponse()
    {
        return response()->json(['success' => false, 'message' => 'Failed to update anime list.'], 500);
    }
    private function findAnimeStatus(array $animeList, $mal_id)
    {
        foreach ($animeList as $anime) {
            if ($anime['mal_id'] == $mal_id) {
                return $anime['status'];
            }
        }
        return 'default';
    }
}
