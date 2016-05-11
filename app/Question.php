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
    public static function unansweredQuestionsCount($user_id = null, $sign) {
        if ($user_id != null) {
            $array_count = array();
            $opinion_id_array = array();
            $total = 0;
            $categories = \AnswerMe\Category::get();

            # Get all the opinions of the user
            # (later we will get every question without an opinion from this user )
            $all_opinions = \AnswerMe\Opinion::where('user_id', '=', $user_id)->get();

            # Convert the opinion question_id('s) to an array for the whereNotIn used in the foreach
            foreach($all_opinions as $opinion) {
                array_push($opinion_id_array, $opinion->question_id);
            }
            # For each category we will count the unanswered questions not asked by this user
            foreach ($categories as $category) {
                # Get a count of the questions the user has not answered since they are NotIn all_opinions
                $count = \AnswerMe\Question::whereNotIn('id', $opinion_id_array)//$all_opinions->toArray())
                    ->whereHas('user', function($query) use ($user_id, $sign) {
                        $query->where('users.id', $sign, $user_id); // don't get questions this user asked.
                    })
                    ->where('category_id', '=', $category->id)
                    ->get()
                    ->count();
                $total += $count; // Keep a total for the 'All' category
                array_push($array_count, $count); // populate the array with each category count
            }
            array_unshift($array_count, $total); // The last value is the category count
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

        # First, get all the questions the user has answered (we don't want these questions)
        $all_opinions = \AnswerMe\Opinion::addSelect(array('question_id'))
        ->where('user_id', '=', $user_id)
        ->get();

        # Second half of the query
        # If the $category_id is set we only want questions from that category.
        # Get all questions the user has not answered for the given category\

        # If we have a category_id value return only questions in that category
        # otherwise do the 'else' and return all questions!
        if ($category_id) {
                $questions = \AnswerMe\Question::with(array('category' => function($query) {
                        $query->addSelect(array('id', 'type'))->get();
                    }))
                    ->with(array('user' => function($query) {
                        $query->with('profile')->addSelect('users.id', 'name');
                    }))
                    ->whereNotIn('id', $all_opinions->toArray())
                    ->where('category_id', '=', $category_id) # <- Don't do this where clause in the else section
                    ->orderBy('created_at', 'ASC')
                    ->get();


        /*    $questions = \AnswerMe\Question::with(array('category' => function($query) {
                    $query->addSelect(array('id', 'type'))->get();
                }))
                ->whereHas('user', function($query) use ($user_id) {
                    $query->where('users.id', '<>', $user_id);
                })
                ->whereNotIn('id', $all_opinions->toArray())
                ->where('category_id', '=', $category_id) # <- Don't do this where clause in the else section
                ->orderBy('created_at', 'ASC')
                ->get();
        */
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

    public static function questionsUserHasAsked($user_id, $category_id) {

            $questions = \AnswerMe\Question::with(array('category' => function($query) {
                    $query->addSelect(array('id', 'type'))->get();
                }))
                ->whereHas('user', function($query) use ($user_id) {
                    $query->where('users.id', '=', $user_id);
                })
                ->where('category_id', '=', $category_id) # <- Don't do this where clause in the else section
                ->orderBy('created_at', 'ASC')
                ->get();

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

    # Adding a new question
    public static function newQuestion($data) {

        $rules = array(
            'question' => 'required',
            'category_id' => 'required|integer',
        );

        dump($data);
        $validator = \Validator::make($data, $rules);
        echo 'here';
        if ($validator->fails()) {
            echo '<br>fail';
            return redirect('/profile')
                ->withErrors($validator)
                ->withInput($data);
        }

        //$user_id = \Auth::user();
        $question = new \AnswerMe\Question();
        $question->question = $data['question'];
        $question->category_id = $data['category_id']; // Need to pass in the category
        $question->save();
        $question->user()->attach(\Auth::id()); // Need to pass in the user??


        foreach ($data['possibility'] as $type) {
            $new_possibility = new \AnswerMe\Possibility();
            $new_possibility->instance = $type;
            $new_possibility->save();
            $question->possibility()->attach($new_possibility->id);
            //echo $new_instance->id . ' ' . $new_instance->instance;
        }
    }

}
