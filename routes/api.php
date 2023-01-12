<?php

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

Route::apiResource('todo-list',\App\Http\Controllers\TodoListController::class);


Route::apiResource('todo-list/{todo_list}/attachment',\App\Http\Controllers\TodoListAttachController::class)->except('update');

Route::apiResource('tag', \App\Http\Controllers\TagController::class);


Route::post('todo-list/{todo_list}/tag',[\App\Http\Controllers\TodoListController::class,'addTag']);
Route::get('todo-list/{todo_list}/tag',[\App\Http\Controllers\TodoListController::class,'getTags']);
