<?php

namespace AnswerMe\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illumintate\Database\Eloquent;

class AnswerController extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    function postAnswer(Request $request) {
        // Validate the input


        // Get the necessary ids
        $user = \Auth::user();
        $question_id = $request->input('question_id');
        $possibility_id = $request->input('possibility_id');

        $opinion = new \AnswerMe\Opinion();
        $opinion->user_id = $user->id;
        $opinion->possibility_id = $possibility_id;
        $opinion->question_id = $question_id;
        $opinion->save();

/*
        if (count($question)) {
            return $question->toJson();
        } else {
            $response = ['id' => 'Record not found' . $question_id];
            return json_encode($response);

        }
        */
    }


}
