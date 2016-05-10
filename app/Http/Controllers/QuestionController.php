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

    function getNewQuestion() {
        return view('questions.new');
    }

    function postNewQuestion(Request $request) {
        //sdump($request);
        $this->validate($request, [
            'question' => 'required|min:10|max:200|alpha_num',
            'possibility.*' => 'required|min:1|max:100|alpha_num',
        ]);
        /*
        $this->validate($request, [
            'question' => 'required|min:10|max:200|alpha_num',
            'possibility.*' => 'required'|'max:5'|'unique'
        ]);
*/
        $data = array('question' => 'Which is better pizza or cheese burgers Which is better pizza or cheese burgers Which is better pizza or cheese burgers Which is better pizza or cheese burgersWhich is better pizza or cheese burgers Which is better pizza or cheese burgers', 'category_id' => 1);
        \AnswerMe\Question::newQuestion($data);
        return 'Question posted';
    }


    function getUsersQuestions() {
        $questions = \AnswerMe\Question::singleUsersQuestions(\Auth::id());

        return view('questions.mine')->with('questions', $questions);
    }

    # Get the questions for this category
    function getQuestions($cat_type) {

        $user = \Auth::user();

        $category_id = \AnswerMe\Category::where('type', '=', $cat_type)->pluck('id')->first();

        //$user_profile = \AnswerMe\Profile::userProfile();
        $questions = \AnswerMe\Question::categoryQuestion($user->id, $category_id);

        return view('questions.category')->with('questions', $questions);
    }

    # Get the questions a user has ASKED by category
    function getPosts($cat_type) {

        $category_id = \AnswerMe\Category::where('type', '=', $cat_type)->pluck('id')->first();

        # If we have a category type get questions only for that category
        # otherwise do the 'else' and return all questions asked by this user.
        if ($category_id) {
            $posted_questions = questionsUserHasAsked(\Auth::id(), $category_id);
        } else {
            $posted_quesitons = \AnswerMe\Question::singleUsersQuestions(\Auth::id());
        }
        return $posted_questions;
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
