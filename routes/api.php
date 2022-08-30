<?php

use App\Http\Controllers\admin\indexControllerAdmin;
use App\Http\Controllers\client\anyController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/getTest', [indexControllerAdmin::class, 'getTest']);

Route::get('/getView', [indexControllerAdmin::class, 'getView']);

Route::get('/api_id_comment', [anyController::class, 'api_id_comment']);