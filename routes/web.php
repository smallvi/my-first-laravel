<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::prefix('api')->group(function (){
//     Route::get('/', function () {
//         return view('welcome');
//     })->name("index.group1");
//     Route::get('test', function () {
//         return view('test');
//     })->name("index.test");
// });

Route::post('edit-todo', [TodoController::class, 'edit']);
Route::post('delete-todo', [TodoController::class, 'destroy']);

Route::resource('todos',TodoController::class);

// Route::get('todosedit', [TodoController::class, 'edit']);