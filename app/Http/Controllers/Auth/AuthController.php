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
        return Validator::make($data, [
            'first' => 'max:255',
            'last' => 'max:255',
            'city' =>'alpha',
            'country' =>'alpha',
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
        dump($city);
        $country = \AnswerMe\Country::where('country', '=', $data['country']);

        $profile = \AnswerMe\Profile::create([
            'user_id' => $user->id,
            'first' => $data['first'],
            'last' => $data['last'],
            'city_id' => 1, //$data['city'],
            'country_id' => 2, //$data['country'],

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

    public function emailSignup() {

    }

}
