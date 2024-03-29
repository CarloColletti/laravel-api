<?php

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Guest\HomeController as GuestHomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ShoeController;

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

// # Guest route
Route::get( '/',    [GuestHomeController::class,    'homepage'  ])->name('homepage');

// # Protected routes
Route::middleware('auth')
    ->prefix('admin')   // * routes url start with "/admin." 
    ->name('admin.')    // * routes name start with "admin." 
    ->group(
        function () {
            Route::get( '/dashboard',   [AdminHomeController::class,    'dashboard' ])->name('dashboard');
        }
    );

// ! Generated routes, do not touch
// # Protected profile's routes
Route::middleware('auth')
    ->prefix('profile')      // * routes url start with "/profile." 
    ->name('profile.')       // * routes name start with "profile." 
    ->group(
        function () {
            Route::get(     '/', [ProfileController::class, 'edit'      ])->name('edit');
            Route::patch(   '/', [ProfileController::class, 'update'    ])->name('update');
            Route::delete(  '/', [ProfileController::class, 'destroy'   ])->name('destroy');
        }
    );


Route::middleware('auth')
    ->prefix('/Admin')
    ->name('Admin.')
    ->group(function () {
    // rotta resouce project 
    Route::get('/shoe/trash', [ShoeController::class, 'trash'])->name('shoe.trash');
    Route::put('/shoe/{Shoe}/restore', [ShoeController::class, 'restore'])->name('shoe.restore');
    Route::delete('/shoe/force-delete', [ShoeController::class, 'forceDelete'])->name('shoe.forceDelete');
    Route::resource('Shoe', ShoeController::class);
});

require __DIR__ . '/auth.php';