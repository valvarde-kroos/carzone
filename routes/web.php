<?php

use App\Http\Controllers\CarCategoryController;
use App\Http\Controllers\CarPostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayersController;

// Route::get($uri, write action for the route);	Handles GET requests.
// Route::post($uri, write action for the route);	Handles POST requests.
// Route::put($uri, write action for the route);	Handles PUT requests (for updates).
// Route::patch($uri, write action for the route);	Handles PATCH requests (for updates).
// Route::delete($uri, write action for the route); Handles DELETE requests.

Route::get('/', function () {
    return view('home');
});

Route::get('/contact', function () {
    return view('contact');
})->name('contact');



Route::get('/signup', [UserController::class, 'showsignup'])->name('signupForm');
Route::post('/signup', [UserController::class, 'store'])->name('register');


Route::get('/login', [UserController::class, 'showlogin'])->name('loginForm');
Route::post('/login', [UserController::class, 'login'])->name('login');



Route::get('/category', [CarCategoryController::class, 'create'])->name('categoryPage');


Route::get('/post', [CarPostController::class, 'create'])->name('carPost');




Route::middleware('auth')->group(function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    Route::post('/category', [CarCategoryController::class, 'store'])->name('category.create');

    Route::post('/post', [CarPostController::class, 'store'])->name('post.create');

    Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');

    Route::get('/post/{id}/edit', [CarPostController::class, 'edit'])->name('editForm');

    Route::put('/post/{id}', [CarPostController::class, 'update'])->name('post.update');

    Route::delete('/post/{id}', [CarPostController::class, 'destroy'])->name('postDelete');

    Route::post('/player', [PlayersController::class, 'store'])->name('players.store');

    Route::get('/player/{player}/edit', [PlayersController::class, 'edit'])->name('players.edit');

    Route::put('/player/{player}', [PlayersController::class, 'update'])->name('players.update');

    Route::get('/players/create', [PlayersController::class, 'create'])->name('players.create');

    Route::delete('/player/{player}', [PlayersController::class, 'destroy'])->name('players.destroy');

    Route::post('/post/{id}/like', [CarPostController::class, 'toggleLike'])->name('post.like');
});


Route::get('/player', [PlayersController::class, 'create'])->name('players.create');



