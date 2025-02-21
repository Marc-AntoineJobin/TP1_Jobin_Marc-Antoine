<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Http\Resources\FilmResource;

class filmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return Film::all();
        try{
            return FilmResource::collection(Film::paginate(FILMS_PAGINATION))->response()->setStatusCode(OK);
        }
        catch(Exception $e){
            abort(SERVER_ERROR, "Server Error");
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
        return (new FilmResource(Film::findOrFail($id)))->response()->setStatusCode(OK);
        }
    catch(QueryException $e){
        abort(NOT_FOUND, "Invalid ID");
    }
    catch(Exception $e){
        abort(SERVER_ERROR, "Internal Server Error");
    }
    }
    
    public function store(Request $request)
    {
        try {
            $film = Film::create($request->all());
            return (new FilmResource($film))->response()->setStatusCode(CREATED);
        }
        catch(QueryException $e){
            abort(UNPROCESSABLE_ENTITY, "Invalid Data");
        }
        catch(Exception $e){
            abort(SERVER_ERROR, "Server Error");
        }
    }

    public function delete(string $id){

        try{
            $film = Film::findOrFail($id);
            $film->delete();
            return response()->json(null, NO_CONTENT);
        }
        catch(QueryException $e){
            abort(NOT_FOUND, "Invalid ID");
        }
        catch(Exception $e){
            abort(SERVER_ERROR, "Internal Server Error");
        }
    }
}
