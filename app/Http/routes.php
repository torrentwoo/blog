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
Route::get('/', 'PageController@index')->name('home');
Route::get('/about', 'PageController@about')->name('about');
Route::get('/contact', 'PageController@contact')->name('contact');
Route::get('/help', ['as'   =>  'help', 'uses'  =>  'PageController@help']);
Route::get('/search', 'PageController@search')->name('search');

// User related routes
Route::get('/auth/register', 'UserController@create')->name('register');
Route::post('/users', 'UserController@store')->name('users.store');
Route::get('/users/activate/{token}', 'UserController@activate')->name('users.activate');
Route::get('/users/{id}', 'UserController@show')->name('users.show');

Route::get('/users/{id}/profile',   'UserController@showProfile')->name('users.updateProfile');
Route::patch('/users/{id}/profile', 'UserController@updateProfile')->name('users.updateProfile');
Route::get('/users/{id}/socials',   'UserController@showSocials')->name('users.updateSocials');
Route::patch('/users/{id}/socials', 'UserController@updateSocials')->name('users.updateSocials');
Route::get('/users/{id}/privacy',   'UserController@showPrivacy')->name('users.updatePrivacy');
Route::patch('/users/{id}/privacy', 'UserController@updatePrivacy')->name('users.updatePrivacy');
Route::get('/users/{id}/assists',   'UserController@showAssists')->name('users.updateAssists');
Route::patch('/users/{id}/assists', 'UserController@updateAssists')->name('users.updateAssists');
Route::get('/users/{id}/account',   'UserController@showAccount')->name('users.updateAccount');
Route::patch('/users/{id}/account', 'UserController@updateAccount')->name('users.updateAccount');

Route::get('/users/{id}/articles',  'UserController@articles')->name('users.articles');
Route::get('/users/{id}/favorites', 'UserController@favorites')->name('users.favorites');
Route::get('/users/{id}/comments',  'UserController@comments')->name('users.comments');
/*
Route::get('/users/{id}/wallet',    'UserController@wallet')->name('users.wallet');
Route::get('/users/{id}/gifts',     'UserController@gifts')->name('users.gifts');
Route::get('/users/{id}/cart',      'UserController@cart')->name('users.cart');*/

// User password rescue routes
Route::get('/help/password/rescue', 'Auth\PasswordController@getEmail')->name('password.rescue');
Route::post('/help/password/rescue', 'Auth\PasswordController@postEmail')->name('password.rescue');
Route::get('/help/password/reset/{token}', 'Auth\PasswordController@getReset')->name('password.reset');
Route::post('/help/password/reset', 'Auth\PasswordController@postReset')->name('password.update');

// Authentication routes
Route::get('/auth/login', 'SessionController@create')->name('login');
Route::post('/auth/login', 'SessionController@store')->name('login');
Route::post('/auth/ajaxLogin', 'SessionController@ajaxLogin')->name('ajaxLogin');
Route::get('/auth/logout', 'SessionController@destroy')->name('logout');

// Columns routes
Route::get('/columns', 'ColumnController@index')->name('columns.index');
Route::get('/columns/{id}', 'ColumnController@show')->name('columns.show');

// Articles routes
Route::get('/articles/create', 'ArticleController@create')->name('write');
Route::post('/articles/draft', 'ArticleController@draft')->name('articles.draft');
Route::get('/articles/{id}', 'ArticleController@show')->name('articles.show');

// Comments routes
Route::get( '/articles/{article}/comments', 'ArticleCommentController@index')->name('articles.comments.index');
Route::post('/articles/{article}/comments', 'ArticleCommentController@store')->name('articles.comments.store');
Route::post('/articles/{article}/comments/{comment}', 'ArticleCommentController@reply')->name('articles.comments.reply');

// Favorites routes
Route::post('/articles/{id}/favorite', 'FavoriteController@addFavoriteArticle')->name('articles.favorite');
Route::delete('/articles/{id}/favorite', 'FavoriteController@revokeFavoriteArticle')->name('articles.favorite');

// Follows routes
Route::post('/columns/{id}/follow', 'FollowController@followColumn')->name('follow.column');
Route::delete('/columns/{id}/follow', 'FollowController@revokeFollowColumn')->name('follow.column');
Route::post('/users/{id}/follow', 'FollowController@followUser')->name('follow.user');
Route::delete('/users/{id}/follow', 'FollowController@revokeFollowUser')->name('follow.user');

// Likes routes
Route::post('/articles/{id}/like', 'LikeController@addLikeArticle')->name('articles.like');
Route::delete('/articles/{id}/like', 'LikeController@revokeLikeArticle')->name('articles.like');

// Votes routes
Route::post('/comments/{id}/favour', 'VoteController@favour')->name('vote.up');
Route::delete('/comments/{id}/favour', 'VoteController@revokeFavour')->name('vote.up');
Route::post('/comments/{id}/blackball', 'VoteController@oppose')->name('vote.down');
Route::delete('/comments/{id}/blackball', 'VoteController@revokeOppose')->name('vote.down');

// Tags routes
Route::get('/tags', 'TagController@index')->name('tags.index');
Route::get('/tags/{id}', 'TagController@show')->name('tags.show');

// Subscription routes
Route::get('/subscriptions', 'SubscriptionController@index')->name('subscriptions.index');
Route::get('/subscriptions/recommendation', 'SubscriptionController@recommend')->name('subscriptions.recommend');
Route::get('/subscriptions/columns/{id}', 'SubscriptionController@followingColumn')->name('subscriptions.column');
Route::get('/subscriptions/users/{id}', 'SubscriptionController@followingUser')->name('subscriptions.user');

// Files routes
Route::get('/files/{filename}', 'FileController@show')->where('filename', '[^\n\r\s]+')->name('files.show');
Route::get('/files/download/{filename}', 'FileController@download')->where('filename', '[^\s]+')->name('files.download');
Route::post('/files/upload/{type}', 'FileController@upload')->name('files.upload');

// Notification and messages routes
Route::get('/notification', 'NotificationController@index')->name('notification.index');
Route::get('/notification/messages', 'MessageController@index')->name('messages.index');
Route::get('/notification/messages/{id}', 'MessageController@show')->name('messages.show');
Route::post('/notification/messages/{id}', 'MessageController@send')->name('messages.send');
Route::delete('/notification/messages/{id}', 'MessageController@destroy')->name('message.delete');
Route::get('/notification/comments', 'NotificationController@comment')->name('notification.comment');
Route::get('/notification/comments/{id}', 'NotificationController@showComment')->name('notification.showComment');
Route::delete('/notification/comments/{id}', 'NotificationController@destroyComment')->name('notification.deleteComment');
Route::get('/notification/requests', 'NotificationController@request')->name('notification.request');
Route::get('/notification/requests/{id}', 'NotificationController@showRequest')->name('notification.showRequest');
Route::delete('/notification/requests/{id}', 'NotificationController@destroyRequest')->name('notification.deleteRequest');
Route::get('/notification/likes', 'NotificationController@like')->name('notification.like');
Route::get('/notification/likes/{id}', 'NotificationController@showLike')->name('notification.showLike');
Route::delete('/notification/likes/{id}', 'NotificationController@destroyLike')->name('notification.deleteLike');
Route::get('/notification/votes', 'NotificationController@vote')->name('notification.vote');
Route::get('/notification/votes/{id}', 'NotificationController@showVote')->name('notification.showVote');
Route::delete('/notification/votes/{id}', 'NotificationController@destroyVote')->name('notification.deleteVote');
Route::get('/notification/follow', 'NotificationController@follow')->name('notification.follow');
Route::get('/notification/follow/{id}', 'NotificationController@showFollow')->name('notification.showFollow');
Route::delete('/notification/follow/{id}', 'NotificationController@destroyFollow')->name('notification.deleteFollow');
Route::get('/notification/rewards', 'NotificationController@reward')->name('notification.reward');
Route::get('/notification/rewards/{id}', 'NotificationController@showReward')->name('notification.showReward');
Route::delete('/notification/rewards/{id}', 'NotificationController@destroyReward')->name('notification.deleteReward');
Route::get('/notification/others', 'NotificationController@others')->name('notification.others');
Route::delete('/notification/others/{id}', 'NotificationController@destroyOthers')->name('notification.deleteOthers');


//--------------------------------------/
//----    Administration routes     ----/
//--------------------------------------/
Route::group(['prefix'  =>  'admin', 'middleware'  =>  'auth.admin', 'namespace'  =>  'Admin'], function() {
    Route::get('/', function() {
        return 'This is the administration backend';
    });
});
