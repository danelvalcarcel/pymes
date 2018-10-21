<?php

namespace App\Http\Controllers\Auth;

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
        $this->middleware('auth');
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
            'correo'=> 'required|string|max:255',
             'clave'=>'required|string|min:6|confirmed',
             'nombres'=> 'required|string|max:255',
             'mobile'=> 'required|numeric|max:255',
             'roleid'=> 'required|numeric|max:255',
             'createdBy'=> 'required|numeric|max:255',
             'createdDtm'=> 'required|date|max:255',
             'updatedBy'=> 'required|numeric|max:255',
             'updatedDtm'=> 'required|date|max:255',
             'id_establecimiento'=> 'required|numeric|max:255',
             'role'=> 'required|numeric|max:255',
             'estado'=> 'required|numeric|max:255'
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
            'correo'=>  $data['correo'],
            'clave'=>   sha1($data['clave']),
            'nombres'=>  $data['nombres'],
            'mobile'=>  $data['mobile'],
            'roleid'=>  $data['roleid'],
            'createdBy'=>  $data['createdBy'],
            'createdDtm'=> $data['createdDtm'],
            'updatedBy'=> $data['updatedBy'],
            'updatedDtm'=> $data['updatedDtm'],
            'id_establecimiento'=> $data['id_establecimiento'],
            'role'=> $data['role'],
            'estado'=> $data['estado'],
        ]);
    }
}
