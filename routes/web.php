<?php

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

Route::get('/', function(){ return view('welcome');})->where('any','.*');
Route::get('/get-offerings','Offerings@GetOfferings');
Route::get('/get-purchases','Purchases@GetPurchases');
Route::post('/create-purchase','Purchases@CreatePurchase');

