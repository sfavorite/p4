<?php

namespace AnswerMe\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illumintate\Database\Eloquent;

class QuestionController extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    # Shows all open questions
    function getAllQuestions() {

        $questions = \AnswerMe\Question::allQuestions();
        $categories = \AnswerMe\Category::sortedCategories();

        return view('question.all')->with('questions', $questions)
                ->with('categories', $categories);
    }


    # List's only questions in a given category
    function postCatQuestions() {
        $questions = \AnswerMe\Question::categoryQuestions(3);
        $categories = \AnswerMe\Category::sortedCategories();

        return view('question.all')->with('questions', $quesitons)
                ->with('categories', $categories);

    }

    function getQuestionOpinions() {

        $question_opinions = \AnswerMe\Question::questionOpinions(1);
        dump($question_opinions);

    }

    function postQuestion() {
        $data = array('question' => 'Which is better pizza or cheese burgers', 'category_id' => 1);
        \AnswerMe\Question::newQuestion($data);
        return 'Question posted';
    }

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
    function postAnswer() {

        echo 'hello';
    }

    # Get the questions for this category
    function getQuestions($cat_type) {

        $user = \Auth::user();
        $category_id = \AnswerMe\Category::where('type', '=', $cat_type)->pluck('id')->first();

        //$user_profile = \AnswerMe\Profile::userProfile();
        $questions = \AnswerMe\Question::categoryQuestion($user->id, $category_id);

        return view('questions.category')->with('questions', $questions);
    }




}
