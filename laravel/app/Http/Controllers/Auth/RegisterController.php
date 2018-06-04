<?php

namespace App\Http\Controllers\Auth;

use GetStream\Stream\Client;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Config;

use App\Profile;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'gender'=>'required|bool',
            'DOB'=>'required|date'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if($data['gender']){
           $avatar='avatar/male.png';
        }else{
            $avatar='vavatar/female.png';
        }
        $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'gender'=>$data['gender'],
            'slug'=>str_slug($data['name']),
            'avatar'=> $avatar,
            'DOB'=>$data['DOB']

        ]);
        Profile::create(['user_id'=>$user->id]);
        $client = new Client(Config::get('stream.key'), Config::get('stream.secret'));
        $client->feed('user', $user->id);
        return $user;
    }
}
