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
            'name' => 'required|unique:users,name,'. \Auth::id(),
            'first' => 'max:255',
            'last' => 'max:255',
            'city' => 'alpha_spaces',
            'country' => 'alpha_spaces',
            'email'=>'required|email|unique:users,email,'. \Auth::id(),
        ]);

        // Get the user and save any name & email changes.
        $user = \Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        // Get the profile so we can update as needed
        $profile = \AnswerMe\Profile::userProfile($user->id);

        $profile->first = $request->input('first');
        $profile->first = $request->input('last');

        // Get the city and country ID
        $city = \AnswerMe\City::where('city', '=', $request->input('city'))->first();
        $country = \AnswerMe\Country::where('country', '=', $request->input('country'))->first();
        // Did the user give us a valide country?
        if (count($country)) {
            $profile->country_id = $country->id;
        }
        // Did the user give us a valide city?
        if (count($city)) {
            $profile->city_id = $city->id;
        }
        $profile->save();
        // Update the profile with any changes
        $profile = \AnswerMe\Profile::userProfile($user->id);

        return view('dashboard.profile')->with('profile', $profile);



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
