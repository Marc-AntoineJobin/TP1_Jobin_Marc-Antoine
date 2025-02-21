<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use App\Http\Resources\LanguageResource;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            return LanguageResource::collection(Language::all())->response()->setStatusCode(OK);
        }
        catch(Exception $e){
            abort(SERVER_ERROR, "Internal Server Error");
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
        return (new LanguageResource(Language::findOrFail($id)))->response()->setStatusCode(OK);
        }
        catch(QueryException $e){
            abort(NOT_FOUND, "Invalid ID");
        }
        catch(Exception $e){
            abort(SERVER_ERROR, "Internal Server Error");
        }
    }
}
