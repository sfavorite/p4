<?php

namespace AnswerMe;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $fillable = [
        'user_id', 'first', 'last', 'city_id', 'country_id'
    ];

    public function user() {
        return $this->belongsTo('AnswerMe\User');
    }

    public function city() {
        return $this->belongsTo('AnswerMe\City');
    }

    public function country() {
        return $this->belongsTo('AnswerMe\Country');
    }

    public static function userProfile($user_id) {

        # Get the users profile information along with their city and country.
        $profile = \AnswerMe\Profile::with(array('city' => function($query) {
            $query->addSelect(array('id', 'city'))->get();

            }))->with(array('country' => function($query) {
                $query->addSelect(array('id', 'country'))->get();
            }))->with(array('user' => function($query) {
                $query->addSelect(array('id', 'name', 'email'))->get();
            }))
                ->where('user_id', '=', $user_id)->first();

        return $profile;
    }
}
