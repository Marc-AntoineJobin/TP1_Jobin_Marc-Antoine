<?php

namespace App\Http\Controllers;

/** * @OA\Info(title="TP1 API", version="1.0") */ 

define("OK", 200);
define("CREATED", 201);
define("NO_CONTENT", 204);
define("BAD_REQUEST", 400);
define("NOT_FOUND", 404);
define("UNPROCESSABLE_ENTITY", 422);
define("SERVER_ERROR", 500);

define("FILMS_PAGINATION", 10);



abstract class Controller
{
    //
}
