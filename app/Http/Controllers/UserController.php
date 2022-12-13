<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //Show create form
    public function create( ){
        return view('users.register');
    }

    //Create user
    public function store(Request $request){

        $formFields = $request->validate([
            'name' =>['required', 'min:3'],
            'email' =>['required_unless:role,admin','email',Rule::unique('users','email')],
            'password'=>'required|confirmed|min:6']);
        //Hash password
        $formFields['password'] = bcrypt($formFields['password']);
        //create user
        $user = User::create($formFields);
        //login
        auth()->login($user);
        return redirect('/')->with('message', 'User created and logged in');
    }
    //logout
    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect('/')->with('message', 'Logged out');
    }
    //show login
    public function login(){
        return view('users.login');
    }
       //show Aluni login
       public function Alumni_login(){
        return view('users.Alumni_login');
    }
    //Authenticate Alumni
    public function authenticate_Alumni(Request $request){
        $formFields = $request->validate([
            'id_number' =>['required'],
            'password'=>'required'
        ]);
        if(auth()->attempt($formFields)){
            $request->session()->regenerate();
            if(Auth::user()->role =='admin'){
            return redirect('/admin/adminpage')->with('message', 'You are now loggen in');
            }
            return redirect('/')->with('message', 'You are now loggen in');
        }
        return back()->withErrors(['id_number'=>'Invlid Credentials'])
        ->onlyInput('id_number');
   }

    //Authenticate
    public function authenticate(Request $request){
        $formFields = $request->validate([
           // 'id_number' =>['required_if:role,alumni'],
            'email' =>['required','email'],
            'password'=>'required'
        ]);
        if(auth()->attempt($formFields)){
            $request->session()->regenerate();
            if(Auth::user()->role =='admin'){
            return redirect('/admin/adminpage')->with('message', 'You are now loggen in');
            }
            return redirect('/')->with('message', 'You are now loggen in');
        }
        return back()->withErrors(['email'=>'Invlid Credentials'])
        ->onlyInput('email');
   }

   //if(Auth::user()->role =='admin'){
   // $formFields = $request->validate([
    //    'id_number' =>['required',],
    //    'password'=>'required'
   // ]);
}

