<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Survey;
use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::put('/surveys/create/{survey}', function (Survey $survey, Request $request){
   $structure = $request->get('json');

   $survey->structure = $structure;

   $survey->save();
});