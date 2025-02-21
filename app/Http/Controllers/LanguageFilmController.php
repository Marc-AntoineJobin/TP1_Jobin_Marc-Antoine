<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use App\Http\Resources\FilmResource;


class LanguageFilm extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        //return Language::find($id)->films;
        try{
            return FilmResource::collection(Language::findOrFail($id)->films)->response()->setStatusCode(OK);
        }
        catch(QueryException $e){
            abort(NOT_FOUND, "Invalid ID");
        }
        catch(Exception $e){
            abort(SERVER_ERROR, "Server Error");
        }
    }

    public function avg_rental_rate($id)
    {
        try{
            return Language::find($id)->films->avg('rental_rate')->response()->setStatusCode(OK);
        }
        catch(QueryException $e){
            abort(NOT_FOUND, "Invalid ID");
        }
        catch(Exception $e){
            abort(SERVER_ERROR, "Server Error");
        }
    }

}
