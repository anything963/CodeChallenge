<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login controllers
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => ['logout', 'checkLogin','postAuthenticate']]);
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
            'name' => 'required|max:255',
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
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Handle a login request to the api.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postAuthenticate(Request $request) {

        //check if name and password is present before assigning credentials
        if (($request->has('name')) && ($request->has('password'))) {
            $credentials = ['name' => $request->input('name'), 'password' => $request->input('password')];
        } else {
            return response([
                'status' => 401,
                'error' => 'Unauthorized',
                'message' => 'Missing Credentials.'
            ], 401);
        }

        //Check if remember me was selected
        if ($request->has('remember')) {
            $remember = $request->input('remember');
        } else {
            $remember = false;
        }

        //Attempt Login
        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            return $user;
        } else {
            return response([
                'status' => 401,
                'error' => 'Unauthorized',
                'message' => 'Bad credentials.'
            ], 401);
        }
    }

    /**
     * Function to check if user is already logged in when the revisit the site
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function checkLogin(Request $request) {
        if (Auth::check()) {
            $user = Auth::user();
            return $user;
        } else {
            return response ([
                'status' => 401,
                'error' => 'Unauthorized',
                'message' => 'Not logged in.'
            ], 403);
        }

    }

    /**
     * Function to logout
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function logout(Request $request){
        Auth::logout();
        return response ([
            'status' => 200,
            'message' => 'Logged out.'
        ], 200);
    }
}
