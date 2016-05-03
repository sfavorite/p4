<?php

namespace AnswerMe;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    function Question() {
        return $this->hasMany('AnswerMe\Question');
    }

    public static function sortedCategories() {
        return \AnswerMe\Category::with('question')->groupBy('type')->orderBy('id', 'ASC')->get();
    }
}
