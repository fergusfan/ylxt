<?php

namespace App\Http\Controllers\Auth;

use App\Model\Doctor;
use App\User;
use Validator;
use Identicon\Identicon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

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
            'name' => 'required',
            'password' => 'required',
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
            'name'     => $data['name'],
            'phone'    => $data['phone'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
            'status'   => true,
            'user_type'=> $data['user_type'],
            'avatar'   => (new Identicon())->getImageDataUri($data['name'], 256),
        ]);
        if($user->user_type==1){
            Doctor::create([
                'user_id'        => $user->id,
                'title'          => $data['title'],
                'department'     => $data['department'],
                'good_at'        => $data['good_at'],
                'service_time'   => $data['service_time'],
            ]);
        }

        return $user;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $this->guard()->login($this->create($request->all()));

        return redirect()->to($this->redirectTo);
    }
}
