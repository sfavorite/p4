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

    function getProfile() {


        $profile = \AnswerMe\Profile::userProfile();
        dump($profile);
        echo 'Alias: ' . $profile->user->name . "<br>";
        echo 'Email: ' . $profile->user->email . "<br>";

        if ($profile->first != null) {
            echo 'First: ' . $profile->first . "<br>";
        }

        if ($profile->last != null) {
            echo 'Last: ' . $profile->last. "<br>";
        }


        if ($profile->city != null) {
            echo 'City: ' . $profile->city->city . "<br>";
        }

        if ($profile->country != null) {
            echo 'Country: ' . $profile->country->country . "<br>";
        }
        echo "<a href=/>Home</a><br>";
        echo "<a href=/logout>Logout</a><br>";

        echo 'Questions<br>';
        $questions = \AnswerMe\Question::allQuestions();
        foreach($questions as $each) {
            echo $each->question . "<br>";
        };
    }




}
