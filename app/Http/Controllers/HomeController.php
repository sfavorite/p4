<?php

namespace AnswerMe\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class HomeController extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    function getHome() {

        $user = \Auth::user();

        # Get all the unasnwered questions for this user.
        $questions = \AnswerMe\Question::allQuestions($user->id);
        # List of all categories so we can display them on the users home page.
        $categories = \AnswerMe\Category::get();
        # An array of the per category unanswered questons for this user.
        $category_count = \AnswerMe\Question::unansweredQuestions($user->id);

        return view('home.index')
            ->with('questions', $questions)
            ->with('categories', $categories)
            ->with('category_count', $category_count);
    }

}
