<?php

namespace App\Http\Controllers;
use App\Models\Film;
use App\Models\Actor; 
use Illuminate\Http\Request;

class FilmActorController extends Controller
{
    /**
     * Display a listing of the resource.
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
