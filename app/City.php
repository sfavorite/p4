<?php

namespace AnswerMe;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function coutries() {
        return $this->belongsToMany('AnswerMe\Country')->withTimestamps();
    }

    public function profiles () {
        return $this->hasMany('AnswerMe\Profile');

    }

    protected $fillable = [
        'city',
    ];
}
