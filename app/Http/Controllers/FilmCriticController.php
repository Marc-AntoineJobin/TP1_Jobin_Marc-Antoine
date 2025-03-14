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
     * @OA\Get(
     *     path="/api/films/{id}/critics",
     *     tags={"FilmCritic"},
     *     summary="Get critics of a film",
     *     description="Get critics of a film",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         description="ID of the film"
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

    /**
     * @OA\Get(
     *     path="/api/films/{id}/average-score",
     *     tags={"FilmCritic"},
     *     summary="Get average score of critics for a film",
     *     description="Get average score of critics for a film",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the film"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found"
     *     )
     * )
     */
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
