<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurrentResidentRequestDocumentController;
use App\Http\Controllers\NewResidentRequestDocumentController;

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

Route::get('/', function() {
    return view('home');
})->name('home');

Route::post('current-resident/requests/confirm/{id}', [CurrentResidentRequestDocumentController::class, 'confirm'])->name('requests.confirm');
Route::resource('current-resident/requests', CurrentResidentRequestDocumentController::class, ['as' => 'current_resident'])->except(['index']);
Route::get('current-resident/requests/create/{id?}', [CurrentResidentRequestDocumentController::class, 'create'])->name('current_resident.requests.create');

Route::resource('new-resident/requests', NewResidentRequestDocumentController::class, ['as' => 'new_resident'])->except(['index', 'edit', 'update']);
