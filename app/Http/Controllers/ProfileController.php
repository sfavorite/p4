<?php

namespace AnswerMe\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class ProfileController extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    // Change the authenticated users profile
    function getChangeProfile() {
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
