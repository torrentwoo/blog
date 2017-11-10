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

// User related routes
Route::get('/auth/register', 'UsersController@create')->name('register');
Route::get('/user/activate/{token}', 'UsersController@activate')->name('user.activate'); // extras located before the resource route
Route::get('/user/account', 'UsersController@edit')->name('user.edit');
Route::resource('/user', 'UsersController', ['except' => ['create', 'edit']]);
// User password rescue routes
Route::get('/help/password/rescue', 'Auth\PasswordController@getEmail')->name('password.rescue');
Route::post('/help/password/rescue', 'Auth\PasswordController@postEmail')->name('password.rescue');
Route::get('/help/password/reset/{token}', 'Auth\PasswordController@getReset')->name('password.reset');
Route::post('/help/password/reset', 'Auth\PasswordController@postReset')->name('password.update');

// Authentication routes
Route::get('/auth/login', 'SessionsController@create')->name('login');
Route::post('/auth/login', 'SessionsController@store')->name('login');
Route::post('/auth/ajaxLogin', 'SessionsController@ajaxLogin')->name('ajaxLogin');
Route::get('/auth/logout', 'SessionsController@destroy')->name('logout');

// Categories routes
Route::get('/column', 'ColumnsController@index')->name('columnIndex');
Route::get('/column/{id}', 'ColumnsController@show')->where('id', '[a-z\d]+')->name('column');

// Articles routes
Route::get('/article/{id}', 'ArticlesController@show')->where('id', '[a-z\d]+')->name('article');
// Comments appended to article routes
Route::get('/article/{id}/comments', 'CommentsController@show')->name('comments');
Route::post('/article/{id}/comments', 'CommentsController@store')->name('comment');

// Tag clouds routes
Route::get('/tagcloud', 'TagsController@index')->name('tagCloud');
// Tags routes
Route::get('/tag/{id}', 'TagsController@show')->name('tag');

/*
 * Temporary testing routes
 */
/*
Route::get('/tagcloud', function() {
    return view('layouts.tagcloud');
})->name('tagcloud');*/
Route::get('/search', function() {
    $keyword = Input::get('keyword');
    $keyword = $keyword ?: null;
    return view('layouts.search')->with('keyword', $keyword);
})->name('search');
