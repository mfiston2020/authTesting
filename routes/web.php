<?php

use Illuminate\Support\Facades\Artisan;
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


Route::get('/optimize', function () {
    Artisan::call('optimize');
    return 'done';
});


Route::get('/migrate', function () {
    Artisan::call('migrate');
    return 'done';
});


Route::get('/l5', function () {
    Artisan::call('l5-swagger:generate');
    return 'done';
});
