<?php

namespace AnswerMe\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

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

    function postNewQuestion() {

        $question = new \AnswerMe\Question();
        $question->question = 'Which is better pizza or cheese burgers';
        $question->category_id = 1;
        $question->save();
        echo 'New question: ' . $question->question;

    }




}
