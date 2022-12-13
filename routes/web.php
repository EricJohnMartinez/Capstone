<?php

use App\Http\Controllers\AdminController;
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



//create Application form
Route::get('/listings/job_apply',
[ListingController::class,'job_apply']
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
//show login Alumni
Route::get('/Alumni_login',
[UserController::class,'Alumni_login'])->name('Alumni_login')->middleware('guest');

//login Alumni
Route::post('/users/authenticate_Alumni',
[UserController::class,'authenticate_Alumni']);
//logins
Route::post('/users/authenticate',
[UserController::class,'authenticate']);

    //create annoucement form
    Route::get('/listings/create_announcement',[ListingController::class,'create_announcement']);
    Route::post('/announcements',[ListingController::class,'store_announcement']);

//login as Admin
Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
    Route::get('/adminpage',[AdminController::class,'adminpage'])->name('admin.adminpage');
    //Admin show Jobs
    Route::get('/admin_job',[AdminController::class,'admin_job'])->name('admin.admin_job');
    //Admin show job form
    Route::get('/admin_job_create',[AdminController::class,'admin_job_create'])->name('admin.admin_job_create');
    //Admin store job form
    Route::get('/admin_job_create_store',[AdminController::class,'admin_job_create_store'])->name('admin.admin_job_create_store');
    //Admin manage job
    Route::get('/admin_job_manage',[AdminController::class,'admin_job_manage'])->name('admin.admin_job_manage');
    Route::delete('/list/{listing}',[AdminController::class,'admin_destroy']);
    Route::put('/list/{listing}',[AdminController::class,'update']);
    //Admin Account
    Route::get('/admin_account',[AdminController::class,'admin_account'])->name('admin.admin_account');
    //Admin Account Create
    Route::get('/admin_account_create',[AdminController::class,'admin_account_create'])->name('admin.admin_account_create');
    Route::post('/users',[AdminController::class,'store']);
    //Admin manage job
    Route::get('/admin_account_manage',[AdminController::class,'admin_account_manage'])->name('admin.admin_account_manage');
    Route::delete('/list/{listing}',[AdminController::class,'admin_destroy']);
    // Admin announcement
    Route::get('/admin_announcement',[AdminController::class,'admin_announcement'])->name('admin.admin_announcemet');
 

});





