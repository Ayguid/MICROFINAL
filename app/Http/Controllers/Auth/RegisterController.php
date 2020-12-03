<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models440\User_Title;

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
      // dd($data);
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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

          // dd($data);

         $usr = User::create([
            'name' => $data['name'],
            'telephone' => $data['telephone'],
            'country_id' => $data['country_id'],
            'company' => $data['company'],
            'address' => $data['address'],
            'city' => $data['city'],
            'country_id' => $data['country_id'],
            'other_country_value' => $data['other_country_value'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // $userJobTitle = new User_Title();
        // $userJobTitle->user_id = $usr->id;
        // $userJobTitle->country_id = session('country')->id;
        // $userJobTitle->title_id = $t[1];
        // $userJobTitle->contactable = false;
        // $userJobTitle->save();

        return $usr->assignRole('user');
    }
}
