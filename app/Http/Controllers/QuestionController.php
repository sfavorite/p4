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

    # Get method for posting new questions.
    function getNewQuestion() {
        # We want the user to be able to choose the category for this quesiton.
        $categories = \AnswerMe\Category::get();

        return view('questions.new')->with('categories', $categories);
    }

    # When a user submits a new question for voting
    function postNewQuestion(Request $request) {

        $this->validate($request, [
            'question' => 'required|min:2|max:200',
            'possibility.*' => 'required|min:1|max:100',
            'type' => 'required|numeric',
        ]);
        $cat = \AnswerMe\Category::find(1);

        # Make sure some sneaky TA didn't send a 'bad' number
        if ($cat) {
            $data = array('question' => $request->input('question'),
                    'possibility' => $request->input('possibility'),
                    'category_id' => $request->input('type'));

            \AnswerMe\Question::newQuestion($data);


            \Session::flash('message', 'Your question has been posted.');

        } else {
            \Session::flash('message', 'Problem with the category');
        }
        $categories = \AnswerMe\Category::get();

        return view('questions.new')->with('categories', $categories);
    }


    # Get the questions this user has posted
    function getUsersQuestions() {
        $questions = \AnswerMe\Question::singleUsersQuestions(\Auth::id());

        return view('questions.mine')->with('questions', $questions);
    }

    # Get the questions for this category
    function getQuestions($cat_type) {

        $user = \Auth::user();

        $category_id = \AnswerMe\Category::where('type', '=', $cat_type)->pluck('id')->first();

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

    function postDelete(Request $request) {

        $user = \Auth::user();
        // Get all questions for this user
        $users_questions = \AnswerMe\Question::singleUsersQuestions($user->id);

        // Get the opinions tied to this questions
        $opinionsToRemove = \AnswerMe\Opinion::questionOpinionsGiven($request->input('question_id'));

        // Delete those opinions
        foreach($opinionsToRemove as $opinion) {
            $opinion->delete();
        }

        // Get the question and detach the possibilities
        $question = \AnswerMe\Question::find($request->input('question_id'));
        $question->possibility()->detach();
        $question->user()->detach();
        $question->delete();

        \Session::flash('message', 'Question Deleted');
        return redirect('/myquestions');
    }



}
