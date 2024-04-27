<?php

use App\Http\Controllers\Admin\Album\AlbumController;
use App\Http\Controllers\Admin\Album\PicturesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

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



        Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware'=>['auth', 'verified']], function() {



                /***** Dashboard *****/
            Route::get('/home',[DashboardController::class,'index'])->name('User-Dashboard');

            Route::get('/custom_logout', [DashboardController::class,'custom_logout'])->name('custom_logout');

                    /***** Profile *****/
                    Route::group(['prefix' => 'Profile', 'as' => 'Profile.'], function () {
                            Route::get('/',[ProfileController::class,'index'])->name('Profile.index');
                            Route::post('/Update-Profile-Admin',[ProfileController::class,'update_profile'])->name('Update-Profile-Admin');
                            Route::get('/Security', [ProfileController::class,'security']);
                            Route::post('/Update-Password', [ProfileController::class,'update_password']);

                    });
                    Route::resource('Album',AlbumController::class)->except(['create','edit']);;
                    Route::post('Album-move',[AlbumController::class,'album_move'])->name('Album.move');
                    Route::resource('Picture',PicturesController::class)->except(['index','create','show']);;
                    Route::get('Picture-Create/{id}',[PicturesController::class,'add'])->name('Picture.add');

        });
