<?php

namespace AnswerMe;

use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    public function Question() {
        return $this->belongsTo('\AnswerMe\Question')->withTimestamps();
    }

    public function Possibility() {
        return $this->hasOne('\AnswerMe\Possibility')->withTimestamps();
    }

    public static function giveOpinion() {

        $user = \Auth::user();

        $opinion = new \AnswerMe\Opinion();


        $opinion->user_id = $user->id;
        $opinion->possibility_id = 1; // Need to pass in the category
        $opinion->question_id = 2;
        $opinion->save();

    }

    # Get all the opinions given for a specific quesiton
    public static function questionOpinionsGiven($question_id) {
        $opinions = \AnswerMe\Opinion::where('question_id', '=', $question_id)->get();

        return $opinions;
    }



}
