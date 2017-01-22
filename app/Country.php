<?php

namespace AnswerMe;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function cities() {
        return $this->belongsToMany('\AnswerMe\City')->withTimestamps();
    }

    public function profiles () {
        return $this->hasMany('AnswerMe\Profile');

    }

    
}
