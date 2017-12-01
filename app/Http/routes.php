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

// Inherent pages routes
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

Route::get('/user/{id}/profile',   'UsersController@showProfile')->name('user.updateProfile');
Route::patch('/user/{id}/profile', 'UsersController@updateProfile')->name('user.updateProfile');
Route::get('/user/{id}/socials',   'UsersController@showSocials')->name('user.updateSocials');
Route::patch('/user/{id}/socials', 'UsersController@updateSocials')->name('user.updateSocials');
Route::get('/user/{id}/privacy',   'UsersController@showPrivacy')->name('user.updatePrivacy');
Route::patch('/user/{id}/privacy', 'UsersController@updatePrivacy')->name('user.updatePrivacy');
Route::get('/user/{id}/assists',   'UsersController@showAssists')->name('user.updateAssists');
Route::patch('/user/{id}/assists', 'UsersController@updateAssists')->name('user.updateAssists');
Route::get('/user/{id}/account',   'UsersController@showAccount')->name('user.updateAccount');
Route::patch('/user/{id}/account', 'UsersController@updateAccount')->name('user.updateAccount');

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

// Columns routes
Route::get('/columns', 'ColumnsController@index')->name('column.index');
Route::get('/columns/{id}', 'ColumnsController@show')->where('id', '[a-z\d]+')->name('column.show');

// Articles routes
Route::get('/articles/{id}', 'ArticlesController@show')->where('id', '[a-z\d]+')->name('article.show');

// Favorites routes
Route::post('/articles/{id}/favorite', 'FavoritesController@addFavoriteArticle')->name('favorite.article');
Route::delete('/articles/{id}/favorite', 'FavoritesController@revokeFavoriteArticle')->name('favorite.article');

// Follows routes
Route::post('/columns/{id}/follow', 'FollowsController@followColumn')->name('follow.column');
Route::delete('/columns/{id}/follow', 'FollowsController@revokeFollowColumn')->name('follow.column');
Route::post('/user/{id}/follow', 'FollowsController@followUser')->name('follow.user');
Route::delete('/user/{id}/follow', 'FollowsController@revokeFollowUser')->name('follow.user');

// Likes routes
Route::post('/articles/{id}/like', 'LikesController@addLikeArticle')->name('like.article');
Route::delete('/articles/{id}/like', 'LikesController@revokeLikeArticle')->name('like.article');

// Comments related routes
Route::get('/articles/{id}/comments', 'CommentsController@show')->name('article.comments');
Route::post('/articles/{id}/comments', 'CommentsController@store')->name('article.comment');

// Tags routes
Route::get('/tags', 'TagsController@index')->name('tag.index');
Route::get('/tags/{id}', 'TagsController@show')->name('tag.show');

// Subscription routes
Route::get('/subscriptions', 'SubscriptionsController@index')->name('subscription.index');
Route::get('/subscriptions/recommendation', 'SubscriptionsController@recommend')->name('subscription.recommend');
Route::get('/subscriptions/column/{id}', 'SubscriptionsController@followingColumn')->name('subscription.column');
Route::get('/subscriptions/user/{id}', 'SubscriptionsController@followingUser')->name('subscription.user');

// Files routes
Route::get('/file/{filename}', 'FilesController@show')->where('filename', '[^\n\r\s]+')->name('file.show');
Route::get('/file/download/{filename}', 'FilesController@download')->where('filename', '[^\s]+')->name('file.download');


//--------------------------------------/
//----    Administration routes     ----/
//--------------------------------------/
Route::group(['prefix'  =>  'admin', 'middleware'  =>  'auth.admin', 'namespace'  =>  'Admin'], function() {
    Route::get('/', function() {
        return 'This is the administration backend';
    });
});
