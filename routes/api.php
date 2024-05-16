<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\productocontroller;
use App\Http\Controllers\Api\ProductoCategoriaController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\categoriacontroller;

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

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
   // Route::resource('posts',NewsController::class);



});





Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);





Route::apiResource('categorias',categoriacontroller::class)->middleware('auth:sanctum');
Route::apiResource('productos', productocontroller::class)->middleware('auth:sanctum');
Route::apiResource('productos-categoria', ProductoCategoriaController::class)->middleware('auth:sanctum');

/*
Route::get('categoria/{id}',[categoriacontroller::class,'show']);

Route::post('addCategoria',[categoriacontroller::class,'insertarCategoria']);

Route::put('updateCategoria/{id}',[categoriacontroller::class,'updateCategoria']);

Route::delete('deleteCategoria/{id}',[categoriacontroller::class,'deleteCategoria']);*/
