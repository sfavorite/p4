<?php

namespace AnswerMe\Http\Controllers\Auth;

use AnswerMe\User;
use Validator;
use AnswerMe\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $loginPath = '/login';
    protected $redirectAfterLogout = '/';
    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */


    protected function validator(array $data)
    {
        // Extend the Validator so we can validate letters and spaces
        Validator::extend('alpha_spaces', function($field, $value, $parameters) {
            return preg_match('/^[\pL\s]+$/u', $value);
        });

        return Validator::make($data, [
            'first' => 'max:255',
            'last' => 'max:255',
            'city' => 'alpha_spaces',
            'country' => 'alpha_spaces',
            'name' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $city = \AnswerMe\City::where('city', '=', $data['city'])->first();
        $country = \AnswerMe\Country::where('country', '=', $data['country'])->first();
        // Since the profile is optional...think Oauth...or a sneaky TA
        if(!count($city)) {
            $city = \AnswerMe\City::where('id', '=', 1)->first(); # Private
        }
        if(!count($country)) {
            $country = \AnswerMe\Country::where('id', '=', 1)->first(); # Private
        }

        $profile = \AnswerMe\Profile::create([
            'user_id' => $user->id,
            'image' => 'img/generic_profile.png',
            'first' => $data['first'],
            'last' => $data['last'],
            'city_id' => $city->id,
            'country_id' => $country->id,
        ]);
        return ($user);
    }

    public function logout()
    {
        \Auth::guard($this->getGuard())->logout();

        \Session::flash('message', 'You have been logged out');

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }

    public function getSignUp() {

        return view('signup.signup');
    }


}
