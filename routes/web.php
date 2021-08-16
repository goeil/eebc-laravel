<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MessageController;

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
Route::get('/hello', function() {

    \Util::sayHello('mimi');

});
Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome');

/* Évènements */
Route::get('evenements/edit/{id?}', 
       [EvenementController::class, 'form'])
       ->name("evenements.edit");
Route::get('evenements/{id}', 
       [EvenementController::class, 'show'])
       ->name("evenements.show");
Route::get('evenements', 
       [EvenementController::class, 'index'])
       ->name("evenements.index");

/* Articles */
Route::get('articles/edit/{id?}', 
       [ArticleController::class, 'form'])
       ->name("articles.edit");
Route::get('articles/{id}', 
       [ArticleController::class, 'show'])
       ->name("articles.show");
Route::get('articles', 
       [ArticleController::class, 'index'])
       ->name("articles.index");
Route::get('articles/delete/{id}', 
       [ArticleController::class, 'destroy'])
       ->name("articles.delete");

/* Messages */
Route::get('messages/edit/{id?}', 
       [MessageController::class, 'form'])
       ->name("messages.edit");
Route::get('messages/{id}', 
       [MessageController::class, 'show'])
       ->name("messages.show");
Route::get('messages', 
       [MessageController::class, 'index'])
       ->name("messages.index");


Route::resource('images', ImageController::class);
Route::get('test', \App\Http\Livewire\Test::class);


Auth::routes();

// Default : tous les objets avec slugs
Route::get('{slug}', [App\Http\Controllers\SlugController::class, 'slug'])->name('object');

