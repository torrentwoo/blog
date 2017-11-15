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

// The extra routes must located before the resource route

// Static pages routes
Route::get('/', 'PagesController@index')->name('home');
Route::get('/about', 'PagesController@about')->name('about');
Route::get('/contact', 'PagesController@contact')->name('contact');
Route::get('/help', ['as'   =>  'help', 'uses'  =>  'PagesController@help']);
Route::get('/search', 'PagesController@search')->name('search');

// User related routes
Route::get('/auth/register', 'UsersController@create')->name('register');
Route::post('/user', 'UsersController@store')->name('user.store');
Route::get('/user/activate/{token}', 'UsersController@activate')->name('user.activate');
Route::get('/user/{id}', 'UsersController@show')->name('user.show');
Route::get('/user/{id}/edit', 'UsersController@edit')->name('user.edit');
Route::patch('/user/{id}', 'UsersController@update')->name('user.update');
Route::get('/user/{id}/articles', 'UsersController@articles')->name('user.articles');
Route::get('/user/{id}/favorites', 'UsersController@favorites')->name('user.favorites');
Route::get('/user/{id}/comments', 'UsersController@comments')->name('user.comments');
/*Route::get('/user/{id}/balance', 'UsersController@balance')->name('user.balance');
Route::get('/user/{id}/gifts', 'UsersController@gifts')->name('user.gifts');
Route::get('/user/{id}/cart', 'UsersController@cart')->name('user.cart');*/

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

// Favorites routes
Route::patch('/articles/{id}/like', 'FavoritesController@addLike')->name('favorite.addLike');
Route::delete('/articles/{id}/like', 'FavoritesController@revokeLike')->name('favorite.revokeLike');
Route::patch('/articles/{id}/mark', 'FavoritesController@addMark')->name('favorite.addMark');
Route::delete('/articles/{id}/mark', 'FavoritesController@revokeMark')->name('favorite.revokeMark');

// Follows routes
Route::post('/user/follow/{id}', 'FollowsController@store')->name('follow.add');
Route::delete('/user/follow/{id}', 'FollowsController@destroy')->name('follow.remove');

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
