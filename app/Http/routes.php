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

# --------------------------------------------------------------------------
# Laravel Authentication
# --------------------------------------------------------------------------
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');

Route::get('/register', 'Auth\AuthController@getRegister');
Route::post('/register', 'Auth\AuthController@postRegister');

Route::get('/logout', 'Auth\AuthController@logout');

# --------------------------------------------------------------------------
# Social (OAuth) Authentication
# --------------------------------------------------------------------------

Route::get('/{provider}/authorize', 'AuthorizeController@getAuthorize');
Route::get('/{provider}/callback', 'CallbackController@getCallback');

# --------------------------------------------------------------------------
# The front page
# --------------------------------------------------------------------------
Route::get('/', function () {
    return view('front');
});

Route::group(['middleware' => 'auth'], function() {

    Route::get('/restricted', 'RestrictedController@getRestricted');
    Route::get('/profile', 'ProfileController@getProfile');
    Route::get('/questions/{category}', 'QuestionController@getQuestions');
    Route::get('/all_questions', 'QuestionController@getAllQuestions');
    Route::get('new_question', 'QuestionController@postQuestion');
    Route::get('home', 'HomeController@getHome');
    Route::get('/postAnswer', 'QuestionController@postAnswer');

});



Route::get('/show-login-status', function() {

    # You may access the authenticated user via the Auth facade
    $user = Auth::user();

    if($user) {
        echo 'You are logged in.';
        dump($user->toArray());
    } else {
        echo 'You are not logged in.';
    }

    return;

});
