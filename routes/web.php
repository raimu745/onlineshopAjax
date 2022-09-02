<?php

use App\Http\Controllers\ShopController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('form',[ShopController::class,'index']);

Route::post('form_add',[ShopController::class,'store'])->name('form.store');  
Route::get('form_show',[ShopController::class,'show'])->name('table.show'); 
Route::get('form_delete',[ShopController::class,'destroy'])->name('form.destroy');
Route::get('form_edit',[ShopController::class,'edit'])->name('form.edit');  