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

        $profile = \AnswerMe\Profile::userProfile(\Auth::id());

        if ($profile) {
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
        }
            echo "<a href=/>Home</a><br>";
            echo "<a href=/logout>Logout</a><br>";

            echo 'Questions<br>';
            $questions = \AnswerMe\Question::allQuestions(\Auth::id());

            foreach($questions as $each) {
                echo $each->user[0]->name . ' asks a ' . $each->category->type . ' question: ' . $each->question . "<br>";
            };

            echo "<a href=/new_question>Ask New Question</a>";

            $qp = \AnswerMe\Question::aQuestionAndPossibilities(1);

            echo $qp->possibility[0]->instance;

            $tst = \AnswerMe\Opinion::giveOpinion();
    }
}
