<?php

namespace AnswerMe\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Validator;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Http\Request;

class ProfileController extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    // Change the authenticated users profile
    function postChangeProfile(Request $request) {
        // Extend the Validator so we can validate letters and spaces
        Validator::extend('alpha_spaces', function($field, $value, $parameters) {
            return preg_match('/^[\pL\s]+$/u', $value);
        });

        $this->validate($request, [
            'first' => 'max:255',
            'last' => 'max:255',
            'city' => 'alpha_spaces',
            'country' => 'alpha_spaces',
            'name' => 'required|max:255|unique:users',
            'image[0]' => 'image|max:1000',
            'email' => 'required|email|max:255|unique:users',
        ]);

        $user = \Auth::user();
        $profile = \AnswerMe\Profile::userProfile($user->id);
        $profile->city_id = 3;
        $profile->save();
    }

    // Show the Authenticated users profile
    function getProfile() {

        $profile = \AnswerMe\Profile::userProfile(\Auth::id());
        return view('dashboard.profile')->with('profile', $profile);

    }

    // Show all users profiles
    public static function getUsersProfiles() {
        $profiles = \AnswerMe\Profile::allProfiles();
        return view('users.profiles')->with('profiles', $profiles);
    }
}
