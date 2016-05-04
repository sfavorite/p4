<?php

namespace AnswerMe;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

class Question extends Model
{

    public function category() {
        return $this->belongsTo('AnswerMe\Category');
    }

    public function opinion() {
        return $this->hasMany('AnswerMe\Opinion');
    }

    public function possibility() {
        return $this->belongsToMany('\AnswerMe\Possibility');
    }

    public function user() {
        return $this->belongsToMany('\AnswerMe\User');
    }


    public static function countQuestions() {
        return \AnswerMe\Question::get()->count();
    }

    # A collectioin of all the open questions with the users id and name
    public static function allQuestions($user_id) {

        $allQuestions = \AnswerMe\Question::with(array('category' => function($query) {
                $query->addSelect(array('id', 'type', 'font'))->get();
            }))->with(array('user' => function($query) {
                $query->addSelect(array('users.id', 'name'))->get();
            }))
            ->get();

        return $allQuestions;
    }

    # A collection of questions by category
    public static function questionsByCategoryProfile() {
        $allQuestions = \AnswerMe\Question::with(array('category' => function($query) {
                $query->addSelect(array('id', 'type', 'font'))->get();
            }))->with(array('user' => function($query) {
                $query->addSelect(array('users.id', 'name'))->get();
            }))
            ->get();

        return $allQuestions;
    }

    public static function aQuestionAndPossibilities($q_id) {
        # Get a question along with it's possibilities.
        $allQuestions = \AnswerMe\Question::with(array('category' => function($query) {
                $query->addSelect(array('id', 'type'))->get();
            }))->with(array('user' => function($query) {
                $query->addSelect(array('users.id', 'name'))->get();
            }))->with(array('possibility' => function($query) {
                $query->addSelect(array('possibilities.id', 'instance'))->get();
            }))
            ->first();

            return $allQuestions;

    }

    public static function questionsInACategory($category) {

    }

    # A list of all the open questions for a given category (Religion, General, Politics)
    public static function categoryQuestions($category_id) {

        $allQuestions = \AnswerMe\Question::with(array('category' => function($query) {
                $query->addSelect(array('id', 'type'))->get();
            }))->with(array('user' => function($query) {
                $query->addSelect(array('users.id', 'name'))->get();
            }))
            ->where('category_id', '=', $category_id)->get();
        return $allQuestions;

    }

    # Return an array of the number (count) of unanswered questions for a given user
    public static function unansweredQuestions($user_id = null) {
        if ($user_id != null) {
            $array_count = array();
            $total = 0;
            $categories = \AnswerMe\Category::get();

            foreach ($categories as $category) {
                # Get all the questions the user has answered
                $all_opinions = \AnswerMe\Opinion::addSelect(array('question_id'))
                    ->where('user_id', '=', $user_id)
                    ->get();

                # Get all questions the user has not answered
                $count = \AnswerMe\Question::whereNotIn('id', $all_opinions->toArray())
                    ->where('category_id', '=', $category->id)
                    ->get()
                    ->count();
                $total += $count;
                array_push($array_count, $count);
            }
            array_push($array_count, $total);
            return $array_count;
        }
    }

    # Return all unanswered questions for a given user in a given category
    public static function categoryQuestion($user_id = null, $category_id) {

        # Get all the questions the user has answered
        $all_opinions = \AnswerMe\Opinion::addSelect(array('question_id'))
        ->where('user_id', '=', $user_id)
        ->get();

        # Get all questions the user has not answered for the given category
        $questions = \AnswerMe\Question::with(array('category' => function($query) {
                $query->addSelect(array('id', 'type'))->get();
            }))
            ->whereNotIn('id', $all_opinions->toArray())
            ->where('category_id', '=', $category_id)
            ->orderBy('created_at', 'ASC')
            ->get();

        return $questions;
    }




    # A particular question and all of the given opinions
    public static function questionOpinions($q_id) {

        $temp = \AnswerMe\Question::with('possibility')
        ->where('id', '=', $q_id)->get();

/*
        $profile = \AnswerMe\Question::with(array('city' => function($query) {
            $query->addSelect(array('id', 'city'))->get();
        }))->with(array('country' => function($query) {
            $query->addSelect(array('id', 'country'))->get();
        }))->with(array('user' => function($query) {
            $query->addSelect(array('id', 'name', 'email'))->get();
        }))
        ->where('user_id', '=', $user_id)->first();
*/
        return $temp;
    }

    public static function newQuestion($data) {

        $rules = array(
            'question' => 'required|alpha',
            'category_id' => 'required|integer',
        );

        $validator = \Validator::make($data, $rules);
        echo 'here';
        if ($validator->fails()) {
            echo '<br>fail';
            return redirect('/profile')
                ->withErrors($validator)
                ->withInput($data);
        }

        $user_id = \Auth::user();
        $question = new \AnswerMe\Question();
        $question->question = $data['question'];
        $question->category_id = 1; // Need to pass in the category
        $question->save();
        $question->user()->attach(1); // Need to pass in the user??


        $possibilities = array('Pizza', 'cheese burgers');
        foreach ($possibilities as $instance) {
            echo 'New ' . $instance;
            $new_instance = new \AnswerMe\Possibility();
            $new_instance->instance = $instance;
            $new_instance->save();
            $question->possibility()->attach($new_instance->id);
            //echo $new_instance->id . ' ' . $new_instance->instance;
        }

    }

    public static function voteQuestion() {


    }
}
