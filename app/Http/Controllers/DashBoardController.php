<?php

namespace AnswerMe\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Http\Request;

class DashBoardController extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;


    function getDashBoard() {

        # Get the user and his profile
        $user = \Auth::user();
        $profile = \AnswerMe\Profile::userProfile($user->id);

        # List of all categories so we can display them on the users home page.
        $categories = \AnswerMe\Category::get();

        # We want questions not posted '<>' by this user.
        $equality = '<>';
        # An array of the count of each categories unanswered questons for this user.
        $category_count = \AnswerMe\Question::unansweredQuestionsCount($user->id, $equality);

        # Get the 10 newest questions
        $ten_newest_questions = \AnswerMe\Question::take(10)->get();

        return view('dashboard.index')
            ->with('profile', $profile)
            ->with('categories', $categories)
            ->with('category_count', $category_count)
            ->with('ten_newest_questions', $ten_newest_questions);
    }




}
