<?php

use App\Http\Controllers\GoogleController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\postController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('api/google/login', [GoogleController::class, 'redirect'])
    ->name('google');

Route::get('api/google/callback',  [GoogleController::class, 'callback']);


Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/post', [postController::class, 'posts']);

Route::middleware('auth:sanctum')->get('/api/show/{id}', [postController::class, 'show']);

// Route::post('/api/posts', [postController::class, 'store']);

Route::middleware('auth:sanctum')->post('/api/posts', [postController::class, 'store']);

Route::middleware('auth:sanctum')->post('/api/messages', [MessageController::class, 'store']);

Route::middleware('auth:sanctum')->get('/api/messages', [MessageController::class, 'index']);
