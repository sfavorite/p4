<?php

namespace AnswerMe\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illumintate\Database\Eloquent;

class JsonController extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;


    function getQuestion(Request $request) {
        $question_id = $request->input('id');

        $question = \AnswerMe\Question::with('possibility')->find($question_id);

        if (count($question)) {
            return $question->toJson();
        } else {
            $response = ['id' => 'Record not found'];
            return json_encode($response);
        }
    }

    function postAnswer(Request $request) {
        // Validate the input


        // Get the necessary ids
        $user = \Auth::user();
        $question_id = $request->input('question_id');
        $possibility_id = $request->input('possibility_id');

        $opinion = new \AnswerMe\Opinion();
        $opinion->user_id = $user->id;
        $opinion->possibility_id = $possibility_id;
        $opinion->question_id = $question_id;
        $opinion->save();

        return json_encode(['Your vote was counted!']);

    }

    function getQuestionCount(Request $request) {

        $user = \Auth::user();
        $equality = '<>';

        # An array of the count of each categories unanswered questons for this user.
        $category_count = \AnswerMe\Question::unansweredQuestionsCount($user->id, $equality);
        return json_encode($category_count);
    }

    // Return list of all cities in a given country
    function getCities(Request $request) {

        $this->validate($request, [
            'key' => 'alpha',
        ]);
        //$cities = \Answerme\City::where('user_id', '=', $user_id)->addSelect(array('id', 'city'))->get();
        $cities = \AnswerMe\City::where('city', 'LIKE', $request->input('key') . '%')->addSelect(array('city'))->get();

        return $cities;
    }

    function getCountries() {

        $countries = \AnswerMe\Country::addSelect(array('country'))->get();

        return $countries;
    }

}
