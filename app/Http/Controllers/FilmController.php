<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Http\Resources\FilmResource;

class FilmController extends Controller
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
            abort(SERVER_ERROR, "Server Error");
        }
    }
    public function search(Request $request)
    {
    return "test";
    $keyword = $request->input('keyword');
    $rating = $request->input('rating');
    $minLength = $request->input('minLength');
    $maxLength = $request->input('maxLength');

    try {
        return "test";
        $query = Film::query();

        if ($keyword) {
            $query->where('title', 'like', '%' . $keyword . '%');
        }

        if ($rating) {
            $query->where('rating', 'like', '%' . $rating . '%');
        }

        if ($minLength) {
            $query->where('length', '>=', $minLength);
        }

        if ($maxLength) {
            $query->where('length', '<=', $maxLength);
        }

        $films = $query->paginate(20);

        return FilmResource::collection($films)->response()->setStatusCode(OK);
    } catch (Exception $e) {
        abort(SERVER_ERROR, "Server Error");
    }
    }
}
