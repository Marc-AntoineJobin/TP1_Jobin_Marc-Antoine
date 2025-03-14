<?php

namespace App\Http\Controllers;
use App\Models\Critic; 
use Illuminate\Http\Request;

class CriticController extends Controller
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
 * @OA\Delete(
 *     path="/api/critics/{id}",
 *     tags={"Critic"},
 *     summary="Deletes a critic",
 *     description="Deletes a critic by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="critic ID"
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="OK"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Found"
 *     )
 * )
 */
    public function delete(string $id){

        try{
            $critic = Critic::findOrFail($id);
            $critic->delete();
            return response()->json(null, NO_CONTENT);
        }
        catch(QueryException $e){
            abort(NOT_FOUND, "Invalid ID");
        }
        catch(Exception $e){
            abort(SERVER_ERROR, "Server Error");
        }
    }
}
