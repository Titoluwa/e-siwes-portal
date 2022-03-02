<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'last_name' => ['required', 'string', 'max:100'],
            'first_name' => ['required', 'string', 'max:100'],
            'middle_name' => ['string', 'max:100'],
            'matric_no' => ['string', 'max:100'],
            'staff_id' => ['string', 'max:100'],
            'faculty' => ['string', 'max:100'],
            'department' => ['required', 'string', 'max:100'],
            'course_of_study' => ['string', 'max:100'],
            'contact_no' => ['required', 'integer'],
            'gender' => ['required', 'string', 'max:100'],          
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
        return User::create([
            'last_name' => $data['last_name'],
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'email' => $data['email'],
            'matric_no' => $data['matric_no'],
            'staff_id' => $data['staff_id'],
            'gender' => $data['gender'],
            'faculty' => $data['faculty'],
            'department' => $data['department'],
            'course_of_study' => $data['course_of_study'],
            'contact_no' => $data['contact_no'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
