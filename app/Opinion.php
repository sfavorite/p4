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

}
