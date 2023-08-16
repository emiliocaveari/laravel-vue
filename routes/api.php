<?php

use App\Http\Controllers\Api\PessoaController;
use App\Http\Controllers\Api\CategoriaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/categoria', [CategoriaController::class,'index']);

Route::get('/pessoa', [PessoaController::class,'index']);
Route::post('/pessoa', [PessoaController::class,'store']);
Route::put('/pessoa/{id}', [PessoaController::class,'update']);
Route::delete('/pessoa/{id}', [PessoaController::class,'delete']);
