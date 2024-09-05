<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserApiController;

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

Route::get('/', function () {
    return view('welcome');
});

// Route to retrieve user details by ID from the API
Route::get('/user/{id?}', [UserApiController::class, 'getUserById']);

// Route to retrieve paginated users by page number
Route::get('/users/{page?}', [UserApiController::class, 'getPaginatedUsers']);

// Route to display the form for creating a new user
Route::get('/create-user-form', [UserApiController::class, 'showCreateUserForm']);

// Route to handle form submission for creating a new user
Route::post('/create-user', [UserApiController::class, 'createUser']);