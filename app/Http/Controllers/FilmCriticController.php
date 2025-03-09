<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Critic;
use App\Http\Resources\FilmResource;
use App\Http\Resources\CriticResource;
class FilmCriticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        try {
            $film = Film::findOrFail($id);
            $critics = CriticResource::collection($film->critics);

            return response()->json([
                'film' => new FilmResource($film),
                'critics' => $critics
            ], 200);
        } catch (QueryException $e) {
            abort(404, "Invalid ID");
        } catch (Exception $e) {
            abort(500, "Server Error");
        }
    }

    public function avg_score($id)
{
    try {
        $film = Film::findOrFail($id);
        $averageScore = $film->critics()->avg('score');
        return response()->json(['average_score' => $averageScore], 200);
    } catch (QueryException $e) {
        abort(404, "Invalid ID");
    } catch (Exception $e) {
        abort(500, "Server Error");
    }
}

    
}
