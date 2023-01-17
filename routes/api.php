<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProblemOneController;
use App\Http\Controllers\Api\ProblemTwoController;
use App\Http\Controllers\Api\ProblemThreeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Part One
Route::get('/problem-one', ProblemOneController::class);
Route::get('/problem-two', ProblemTwoController::class);
Route::get('/problem-three', ProblemThreeController::class);



// Part Two
Route::post('/user/register', [UserController::class, 'createUser']);
Route::post('/user/login', [UserController::class, 'loginUser']);
Route::get('/user/{id}', [UserController::class, 'getUser']);
Route::get('/users', [UserController::class, 'getAllUsers']);
Route::put('/user/update/{id}', [UserController::class, 'updateUser']);
Route::delete('/user/{id}', [UserController::class, 'deleteUser']);
