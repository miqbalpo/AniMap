<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;

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

        if (!$this->saveUser($user)) {
            return $this->saveErrorResponse();
        }

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
        $request->validate([
            'mal_id' => 'required|integer',
            'status' => 'required|string|in:liked,plan_to_watch,currently_watching,disliked,wont_watch,unwatched'
        ]);
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
        return is_string($user->anime_list) ? json_decode($user->anime_list, true) : ($user->anime_list ?? []);
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

    private function saveUser(User $user)
    {
        try {
            $user->save();
            return true;
        } catch (\Exception $e) {
            Log::error('Error saving user anime list', ['error' => $e->getMessage()]);
            return false;
        }
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
