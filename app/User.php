<?php

namespace AnswerMe;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public function profile() {
        return $this->hasOne('\AnswerMe\Profile');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function usersQuestions() {
        
    }
}
