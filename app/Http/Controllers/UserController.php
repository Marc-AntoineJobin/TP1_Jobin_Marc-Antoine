<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $user = User::create($request->all());
            return (new UserResource($user))->response()->setStatusCode(CREATED);
        }
        catch(QueryException $e){
            abort(UNPROCESSABLE_ENTITY, "Invalid Data");
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
    try {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return (new UserResource($user))->response()->setStatusCode(OK);
    } catch (QueryException $e) {
        abort(UNPROCESSABLE_ENTITY, "Invalid Data");
    } catch (Exception $e) {
        abort(SERVER_ERROR, "Server Error");
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
