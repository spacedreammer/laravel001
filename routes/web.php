<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingControler;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/hello', function () {
//     return response("<h1>Hello</h1>", 200)
//         ->header('Content-Type', 'text/plain');
// });

// Route::get('/search', function (Request $request) {
//     // return $request->name . ' ' . $request->city;
//     dd($request);
// });

//I changed that below into controller 
// Route::get('/', function () {
//     return View('listings', [
//         'heading' => 'Latest Listing',
//         'listings' => Listing::all()

//     ]);
// });

// Route::get(
//     '/listings/{listing}',
//     function (Listing $listing) {
//         return view('listing', [
//             'listing' => $listing
//         ]);
//     }

// );

//using controller below
//All listing
Route::get('/', [ListingControler::class, 'index']);


//Show create form
Route::get('/listings/create/', [ListingControler::class, 'create'])->middleware('auth');

//Store listing data
Route::post('/listings', [ListingControler::class, 'store'])->middleware('auth');

//show Edit Form

Route::get('/listings/{listing}/edit', [ListingControler::class, 'edit'])->middleware('auth');

//update listing
Route::put('/listings/{listing}', [ListingControler::class, 'update'])->middleware('auth');

//Delete list
Route::delete('/listings/{listing}', [ListingControler::class, 'destroy'])->middleware('auth');

//Manage Listings
Route::get('/listing/mange', [ListingControler::class, 'manage'])->middleware('auth');

//Single listing
Route::get('/listings/{listing}', [ListingControler::class, 'show']);

//Show Register/Create form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');


//Create New User
Route::post('/users', [UserController::class, 'store']);

//Log User Out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

//Show Log in form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

//Log in User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);
