<?php

namespace AnswerMe;

use Illuminate\Database\Eloquent\Model;

class Possibility extends Model
{
    function opinion() {
        return $this->hasOne('\AnswerMe\Possibility');
    }

    function question() {
        return $this->belongsToMany('\AnswerMe\Question');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
/*    protected $fillable = [
        'instance'
    ];
*/
}
