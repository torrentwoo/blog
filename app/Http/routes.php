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

// Static pages routes
Route::get('/', 'PagesController@index')->name('home');
Route::get('/about', 'PagesController@about')->name('about');
Route::get('/contact', 'PagesController@contact')->name('contact');
Route::get('/help', ['as'   =>  'help', 'uses'  =>  'PagesController@help']);
Route::get('/search', 'PagesController@search')->name('search');

// User related routes
Route::get('/auth/register', 'UsersController@create')->name('register');
Route::get('/user/activate/{token}', 'UsersController@activate')->name('user.activate');
Route::get('/user/account', 'UsersController@edit')->name('user.edit'); // the extra routes must located before the resource route
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
Route::get('/columns/{id}', 'ColumnsController@show')->where('id', '[a-z\d]+')->name('column');

// Articles routes
Route::get('/articles/{id}', 'ArticlesController@show')->where('id', '[a-z\d]+')->name('article');

// Comments appended to article routes
Route::get('/articles/{id}/comments', 'CommentsController@show')->name('comments');
Route::post('/articles/{id}/comments', 'CommentsController@store')->name('comment');

// Tag clouds routes
Route::get('/tags', 'TagsController@index')->name('tags');
// Tags routes
Route::get('/tags/{id}', 'TagsController@show')->name('tag');


//--------------------------------------/
//----    Administration routes     ----/
//--------------------------------------/
Route::group(['prefix'  =>  'admin', 'middleware'  =>  'auth.admin', 'namespace'  =>  'Admin'], function() {
    Route::get('/', function() {
        return 'This is the administration backend';
    });
});
