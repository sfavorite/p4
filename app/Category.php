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

/*
    public static function countCategory() {

        $counts = \DB::select(\DB::raw('select categories.type, categories.id, categories.font, count(questions.category_id) as count from categories left join questions on categories.id
            = questions.category_id group by categories.type, questions.category_id order by categories.id'));

        return $counts;
    }
*/

}
