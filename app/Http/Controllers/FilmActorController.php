<?php

namespace App\Http\Controllers;
use App\Models\Film;
use App\Models\Actor; 
use Illuminate\Http\Request;

class FilmActorController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/films/{id}/actors",
     *     tags={"FilmActor"},
     *     summary="Get actors of a film",
     *     description="Get actors of a film",
     *      @OA\Parameter (
     *       description=“film id",
     *       in="path",
     *       name="id",
     *       required=true)

     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found"
     *     )
     * )
     */
    public function index($id)
    {
        //TODO : Récupérer les acteurs d'un film
        try {
            $film = Film::findOrFail($id);
            $actors = $film->actors;
            return response()->json($actors, 200);
        } catch (QueryException $e) {
            abort(404, "Invalid ID");
        } catch (Exception $e) {
            abort(500, "Server Error");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
