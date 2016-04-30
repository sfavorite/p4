<?php

namespace AnswerMe;

use Illuminate\Database\Eloquent\Model;

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

    # A list of all the open questions
    public static function allQuestions() {
        # Get the users profile information along with their city and country.
        $allQuestions = \AnswerMe\Question::with(array('category' => function($query) {
            $query->addSelect(array('id', 'type'))->get();
            }))
            ->get();

        return $allQuestions;

    }

    # A list of all the open questions for a given category (Religion, General, Politics)
    public static function categoryQuestions($cat = 2) {
        # Get the users profile information along with their city and country.
        $allQuestions = \AnswerMe\Question::with(array('category' => function($query) {
            $query->addSelect(array('id', 'type'))->get();
            }))
            ->where('category_id', '=', $cat)->get();

        return $allQuestions;

    }


    # A question and all of the given opinions
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
}
