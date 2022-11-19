<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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
// All Listing
Route::get('/',[ListingController::class,
 'index']);

//show post jobs form
Route::get('/listings/create',
[ListingController::class,'create'])
->middleware('auth');

// store Listing
Route::post('/listings',
[ListingController::class,'store']
)->middleware('auth');

//calender
Route::get('/listings/calendar',
[ListingController::class,'calendar']
);

//create annoucement form
Route::get('/listings/create_announcement',
[ListingController::class,'create_announcement']
);

// store create announcement
Route::post('/announcement',
[ListingController::class,'store_announcement']
)->middleware('auth');


//feed
Route::get('/listings/feed',
[ListingController::class,'feed']
);

//job
Route::get('/listings/job',
[ListingController::class,'job']
);

//show edit
Route::get('/list/{listing}/edit',
[ListingController::class,'edit'])->middleware('auth');

//update listing
Route::put('/list/{listing}',
[ListingController::class,'update']
)->middleware('auth');

//delete listing
Route::delete('/list/{listing}',
[ListingController::class,'destroy']
)->middleware('auth');

//Manage jobs
Route::get('/listings/manage',
[ListingController::class,'manage'])->middleware('auth');

// Single Listing
Route::get('/list/{listing}',
[ListingController::class,'show']
);

//show create form
Route::get('/register',
[UserController::class,'create'])->middleware('guest');

//create user
Route::post('/users',
[UserController::class,'store']);

//Logout
Route::post('/logout',
[UserController::class,'logout'])->middleware('auth');

//show login
Route::get('/login',
[UserController::class,'login'])->name('login')->middleware('guest');

//login
Route::post('/users/authenticate',
[UserController::class,'authenticate']);

