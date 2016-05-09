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

Route::get('/signup', 'Auth\AuthController@getSignUp'); # What method (email or github)

Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');

Route::get('/email-signup', 'Auth\AuthController@getRegister');
Route::post('/email-signup', 'Auth\AuthController@postRegister');

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

    Route::get('/profile', 'ProfileController@getProfile');

    Route::get('/questions/{category}', 'QuestionController@getQuestions');
//    Route::get('/posts/{category}', 'QuestionController@getPosts');

    Route::get('new_question', 'QuestionController@postQuestion');


    Route::get('dashboard', 'DashBoardController@getDashBoard');


    Route::get('/delete', 'QuestionController@getDelete');
    Route::post('/deleteConfirm', 'QuestionController@postDelete');
    Route::get('/changeProfile', 'DashBoardController@getChangeProfile');

    # Json Routes
    Route::post('/answer', 'JsonController@postAnswer');
    Route::get('/question', 'JsonController@getQuestion');
    Route::get('/questionCount', 'JsonController@getQuestionCount');

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
