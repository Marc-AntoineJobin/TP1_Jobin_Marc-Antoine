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

    // ...existing code...
}