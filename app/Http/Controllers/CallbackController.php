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
        if ($user) {
            return redirect('/dashboard');
        //    return Redirect::intended();

        } else {
            echo 'we got problems';
        }

    }

}
