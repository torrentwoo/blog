<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Fore-end layouts demo
Route::get('/demo', function() {
    return view('layouts.home');
});
Route::get('/column', function() {
    return view('layouts.column');
})->name('column');
Route::get('/column/{id}', function($id) {
    return view('layouts.article', compact('id'));
})->name('show');
Route::get('/tag/{id}', function($id) {
    return view('layouts.tag', ['id' => $id]);
})->name('tag');
Route::get('/tagcloud', function() {
    return view('layouts.tagcloud');
})->name('tagcloud');
Route::get('/column/{id}/comments', function($id) {
    return view('layouts.comments')->with('id', $id);
})->name('comments');
Route::get('/search', function() {
    return view('layouts.search');
})->name('search');
