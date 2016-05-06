<?php

namespace AnswerMe;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

class Question extends Model
{

    public function category() {
        return $this->belongsTo('AnswerMe\Category');
    }

    public function opinion() {
        return $this->hasMany('AnswerMe\Opinion');
    }

    public function possibility() {
        return $this->belongsToMany('\AnswerMe\Possibility');
    }

    public function user() {
        return $this->belongsToMany('\AnswerMe\User');
    }


    public static function countQuestions() {
        return \AnswerMe\Question::get()->count();
    }


    # A collectioin of all the open questions
    public static function allQuestionsByOtherUsers($user_id) {

        $allQuestions = \AnswerMe\Question::with(array('category' => function($query) {
                $query->addSelect(array('id', 'type', 'font'))->get();
            }))->with(array('user' => function($query) {
                $query->addSelect(array('users.id', 'name'))->get();
            }))

            ->whereHas('user', function($query) use ($user_id) {
                $query->where('users.id', '<>', 1);
            })

            ->get();

        return $allQuestions;
    }



    # A collection of questions by category
    public static function questionsByCategoryProfile() {
        $allQuestions = \AnswerMe\Question::with(array('category' => function($query) {
                $query->addSelect(array('id', 'type', 'font'))->get();
            }))->with(array('user' => function($query) {
                $query->addSelect(array('users.id', 'name'))->get();
            }))
            ->get();

        return $allQuestions;
    }

    public static function aQuestionAndPossibilities($q_id) {
        # Get a question along with it's possibilities.
        $allQuestions = \AnswerMe\Question::with(array('category' => function($query) {
                $query->addSelect(array('id', 'type'))->get();
            }))->with(array('user' => function($query) {
                $query->addSelect(array('users.id', 'name'))->get();
            }))->with(array('possibility' => function($query) {
                $query->addSelect(array('possibilities.id', 'instance'))->get();
            }))
            ->first();

            return $allQuestions;

    }


    # A list of all the open questions for a given category (Religion, General, Politics)
    public static function questionsInACategory($category_id) {

        $allQuestions = \AnswerMe\Question::with(array('category' => function($query) {
                $query->addSelect(array('id', 'type'))->get();
            }))->with(array('user' => function($query) {
                $query->addSelect(array('users.id', 'name'))->get();
            }))
            ->where('category_id', '=', $category_id)->get();
        return $allQuestions;

    }

    # Return an array of the number (count) of unanswered questions for a given user
    public static function unansweredQuestionsCount($user_id = null) {
        if ($user_id != null) {
            $array_count = array();
            $opinion_id = array();
            $total = 0;
            $categories = \AnswerMe\Category::get();

            # Get all the opinions of the user
            $all_opinions = \AnswerMe\Opinion::where('user_id', '=', $user_id)->get();

            # Convert the opinion id's to an array for the whereNotIn used in the foreach
            foreach($all_opinions as $opinion) {
                array_push($opinion_id, $opinion->id);
            }
            # For each category we will count the unanswered questions
            foreach ($categories as $category) {
                # Get a count of the questions the user has not answered since they are NotIn all_opinions
                $count = \AnswerMe\Question::whereNotIn('id', [1])//$all_opinions->toArray())
                    ->whereHas('user', function($query) use ($user_id) {
                        $query->where('users.id', '<>', $user_id); // don't get questions this user asked.
                    })
                    ->where('category_id', '=', $category->id)
                    ->get()
                    ->count();
                $total += $count;

                array_push($array_count, $count);
            }
            array_push($array_count, $total);
            return $array_count;
        }
    }

    # Get the questions a specific ($users_id) has asked
    public static function singleUsersQuestions($users_id) {
        $users_questions = \AnswerMe\Question::whereHas('user', function($query) use ($users_id) {
            $query->where('users.id', '=', $users_id);
        })->get();

        return $users_questions;
    }


    # Return all unanswered questions for a given user in a given category
    public static function categoryQuestion($user_id = null, $category_id) {

        # This is a simulated sub-query. It is easier to read as two seperate queries

        # First, get all the questions the user has answered
        $all_opinions = \AnswerMe\Opinion::addSelect(array('question_id'))
        ->where('user_id', '=', $user_id)
        ->get();

        # Second half of the query
        # If the $category_id is set we only want questions from that category.
        # Get all questions the user has not answered for the given category\

        # If we have a category_id value return only that value
        if ($category_id) {
            $questions = \AnswerMe\Question::with(array('category' => function($query) {
                    $query->addSelect(array('id', 'type'))->get();
                }))
                ->whereHas('user', function($query) use ($user_id) {
                    $query->where('users.id', '<>', $user_id);
                })
                ->whereNotIn('id', $all_opinions->toArray())
                ->where('category_id', '=', $category_id) # <- Don't do this where clause in the else section
                ->orderBy('created_at', 'ASC')
                ->get();
        } else {
            $questions = \AnswerMe\Question::with(array('category' => function($query) {
                    $query->addSelect(array('id', 'type'))->get();
                }))
                ->whereHas('user', function($query) use ($user_id) {
                    $query->where('users.id', '<>', $user_id);
                })
                ->whereNotIn('id', $all_opinions->toArray())
                ->orderBy('created_at', 'ASC')
                ->get();

        }

        return $questions;
    }




    # A particular question and all of the given opinions
    public static function questionOpinions($q_id) {

        $temp = \AnswerMe\Question::with('possibility')
        ->where('id', '=', $q_id)->get();


        $profile = \AnswerMe\Question::with(array('city' => function($query) {
            $query->addSelect(array('id', 'city'))->get();
        }))->with(array('country' => function($query) {
            $query->addSelect(array('id', 'country'))->get();
        }))->with(array('user' => function($query) {
            $query->addSelect(array('id', 'name', 'email'))->get();
        }))
        ->where('user_id', '=', $user_id)->first();

        return $temp;
    }

    public static function newQuestion($data) {

        $rules = array(
            'question' => 'required',
            'category_id' => 'required|integer',
        );

        $validator = \Validator::make($data, $rules);
        echo 'here';
        if ($validator->fails()) {
            echo '<br>fail';
            return redirect('/profile')
                ->withErrors($validator)
                ->withInput($data);
        }

        $user_id = \Auth::user();
        $question = new \AnswerMe\Question();
        $question->question = $data['question'];
        $question->category_id = 1; // Need to pass in the category
        $question->save();
        $question->user()->attach(1); // Need to pass in the user??


        $possibilities = array('Pizza', 'cheese burgers');
        foreach ($possibilities as $instance) {
            echo 'New ' . $instance;
            $new_instance = new \AnswerMe\Possibility();
            $new_instance->instance = $instance;
            $new_instance->save();
            $question->possibility()->attach($new_instance->id);
            //echo $new_instance->id . ' ' . $new_instance->instance;
        }

    }

    public static function voteQuestion() {


    }
}
