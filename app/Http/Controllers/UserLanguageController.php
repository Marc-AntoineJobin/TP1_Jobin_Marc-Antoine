<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Exception;

class UserLanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * @OA\Get(
     *     path="/api/users/{id}/favorite-language",
     *     tags={"UserLanguage"},
     *     summary="Get favorite language of a user",
     *     description="Get favorite language of a user",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the user"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found"
     *     )
     * )
     */
    public function fav_language($id)
    {
        try {
            $user = User::findOrFail($id);
            $languages = Language::all();
            $criticsCount = [];

            foreach ($languages as $language) {
                $criticsCount[$language->name] = $user->critics()->whereHas('film', function ($query) use ($language) {
                    $query->where('language_id', $language->id);
                })->count();
            }

            $favoriteLanguage = array_search(max($criticsCount), $criticsCount);

            return response()->json(['favorite_language' => $favoriteLanguage], 200);
        } catch (QueryException $e) {
            abort(404, "Invalid ID");
        } catch (Exception $e) {
            abort(500, "Server Error");
        }
    }
}