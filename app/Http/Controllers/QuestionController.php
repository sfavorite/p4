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

    # List's only questions in a given category
    function postCatQuestions() {
        $questions = \AnswerMe\Question::questionsInACategory(3);
        $categories = \AnswerMe\Category::sortedCategories();

        return view('question.all')->with('questions', $quesitons)
                ->with('categories', $categories);
    }


    function postQuestion() {
        $data = array('question' => 'Which is better pizza or cheese burgers Which is better pizza or cheese burgers Which is better pizza or cheese burgers Which is better pizza or cheese burgersWhich is better pizza or cheese burgers Which is better pizza or cheese burgers', 'category_id' => 1);
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

    # Get the questions for this category
    function getQuestions($cat_type) {

        $user = \Auth::user();

        $category_id = \AnswerMe\Category::where('type', '=', $cat_type)->pluck('id')->first();

        //$user_profile = \AnswerMe\Profile::userProfile();
        $questions = \AnswerMe\Question::categoryQuestion($user->id, $category_id);

        return view('questions.category')->with('questions', $questions);
    }

    function getDelete() {
        $user = \Auth::user();
        // Get all questions for this user
        $users_questions = \AnswerMe\Question::singleUsersQuestions($user->id);
        dump($users_questions);

        // Get the opinions tied to this questions
        $opinionsToRemove = \AnswerMe\Opinion::questionOpinionsGiven(1);
        dump($opinionsToRemove);
        // Delete those opinions
        foreach($opinionsToRemove as $opinion) {
            $opinion->delete();
        }

        // Get the question and detach the possibilities
        $question = \AnswerMe\Question::find(1);
        $question->possibility()->detach();
        $question->user()->detach();
        $question->delete();
    }



}
