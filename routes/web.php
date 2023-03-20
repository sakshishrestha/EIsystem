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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('expenses','App\Http\Controllers\ExpenseController');
Route::resource('income','App\Http\Controllers\IncomeController');
Route::any('/reports/index', 'App\Http\Controllers\ReportController@index')->name('reports');

// Route::get('/file-import',[App\Http\Controllers\UserController::class,'importView'])->name('import-view');
// Route::post('/import',[App\Http\Controllers\UserController::class,'import'])->name('import');
// Route::get('/export-users',[App\Http\Controllers\UserController::class,'exportUsers'])->name('export-users');

Route::get('expenses/file-import',[App\Http\Controllers\ExpenseController::class,'importView'])->name('import-view');
Route::post('expenses/import',[App\Http\Controllers\ExpenseController::class,'import'])->name('import');
Route::get('export-expenses',[App\Http\Controllers\ExpenseController::class,'exportExpenses'])->name('export-expenses');


Route::get('income/file-import',[App\Http\Controllers\IncomeController::class,'importView'])->name('import-view');
Route::post('income/import',[App\Http\Controllers\IncomeController::class,'import'])->name('import');
Route::get('export-income',[App\Http\Controllers\IncomeController::class,'exportIncomes'])->name('export-income');
