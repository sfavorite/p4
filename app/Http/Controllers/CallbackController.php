<?php

namespace AnswerMe\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class CallbackController extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    function getCallback($provider) {

        try {
            \SocialAuth::login($provider, function ($user, $userDetails) {
                $user->email = $userDetails->email;
                $user->name = $userDetails->nickname;
                $user->save();
            });
        } catch (ApplicationRejectedException $e) {
            echo 'User rejected application';
        } catch (InvalidAuthorizationCodeException $e) {
            echo 'Authorization was attempted with invalid code.';
        }

        $user = \Auth::user();

        if($user) {
            // See if this user has a profile. If not create a private one.
            // The user can update their information if they want to.
            $profile = \AnswerMe\Profile::userProfile($user->id);
            if (!count($profile)) {
                $profile = new \AnswerMe\Profile();
                $profile->city_id = 1;
                $profile->country_id = 1;
                $profile->first = 'Private';
                $profile->last = 'Private';
                $profile->image = '../img/generic_profile.png';
                $profile->user_id = $user->id;
                $profile->save();
            }

            return redirect('/dashboard');
        //    return Redirect::intended();

        } else {
            echo 'we got problems';
        }

    }

}
