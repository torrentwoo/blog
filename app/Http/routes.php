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

// Home route
Route::get('/', 'HomepageController@index')->name('home');

// Static pages routes
Route::get('/about', 'StaticPagesController@about')->name('about');
Route::get('/contact', 'StaticPagesController@contact')->name('contact');
Route::get('/help', ['as'   =>  'help', 'uses'  =>  'StaticPagesController@help']);

// Authentication routes
Route::get('/auth/login', 'SessionsController@create')->name('login');
Route::post('/auth/login', 'SessionsController@store')->name('login');
Route::get('/auth/logout', 'SessionsController@destroy')->name('logout');

// Categories routes
Route::get('/column', 'ColumnsController@index')->name('columnIndex');
Route::get('/column/{id}', 'ColumnsController@show')->where('id', '[a-z\d]+')->name('column');

// Articles routes
Route::get('/article/{id}', 'ArticlesController@show')->where('id', '[a-z\d]+')->name('article');
// Comments appended to article routes
Route::get('/article/{id}/comments', 'CommentsController@show')->name('comments');

/*
 * Temporary testing routes
 */
/*
Route::get('/column', function() {
    return view('layouts.column');
})->name('column');
*/
/*
Route::get('/article/{id}', function($id) {
    return view('layouts.article', compact('id'));
})->name('show');*/
Route::get('/tag/{id}', function($id) {
    return view('layouts.tag', ['id' => $id]);
})->name('tag');
Route::get('/tagcloud', function() {
    return view('layouts.tagcloud');
})->name('tagcloud');
/*
Route::get('/article/{id}/comments', function($id) {
    return view('layouts.comments')->with('id', $id);
})->name('comments');*/
Route::get('/search', function() {
    $keyword = Input::get('keyword');
    $keyword = $keyword ?: null;
    return view('layouts.search')->with('keyword', $keyword);
})->name('search');
