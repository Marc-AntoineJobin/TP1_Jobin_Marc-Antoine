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
     * @OA\Post(
     *     path="/api/users",
     *     tags={"User"},
     *     summary="Create a new user",
     *     description="Creates a new user",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="title",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="duration",
     *                     type="int"
     *                 ),
     *                 @OA\Property(
     *                     property="album_id",
     *                     type="int"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Invalid Data"
     *     )
     * )
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
 * @OA\Put(
 *     path="/users/{id}",
 *     summary="Updates a user",
 *     @OA\Parameter(
 *         description="Parameter with mutliple examples",
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(type="string"),
 *         @OA\Examples(example="int", value="1", summary="An int value."),
 *         @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value."),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK"
 *     )
 * )
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
