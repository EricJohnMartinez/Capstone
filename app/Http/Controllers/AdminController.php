<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
//show admin panel

public function adminpage(){
    return view('admin.adminpage', [
        'list'=> Listing::latest()->
        filter(request(['tag','search']))->paginate(10)
    ]);
}

public function admin_announcement(){
    return view('admin.admin_announcement', [
        'list'=> Listing::latest()->
        filter(request(['tag','search']))->paginate(10)
    ]);
}

public function admin_job(){
    return view('admin.admin_job', [
        'list'=> Listing::latest()->
        filter(request(['tag','search']))->paginate(10)
    ]);
}

public function admin_job_create(){
    return view('admin.admin_job_create');
}

public function admin_job_create_store(Request $request){
    $formFields = $request->validate([
        'title'=> 'required',
        'company' => ['required',Rule::unique('listings',
        'company') ],
        'location' => 'required',
        'email' => ['required' ,'email'],
        'tags' => 'required',
        'descript' => 'required'
    ]);
    if($request->hasFile('logo')){
$formFields['logo']= $request->file('logo')
->store('logos','public');
    }
    $formFields['user_id']= auth()->id();
    Listing::create($formFields);
    return redirect('/admin/admin_job')->with('message', "Job has been posted");

}

public function admin_job_manage(){
    return view('admin.admin_job_manage',
    ['listings'=>Listing::latest()->get()]);
}

public function admin_account(){
    return view('admin.admin_account');
}

public function admin_account_create( ){
    return view('admin.admin_account_create');
}

public function store(Request $request){
        $formFields = $request->validate([
            'name' =>['required', 'min:3'],
            'id_number'=>[Rule::unique('users','id_number')],
            'email' =>['required_unless:role,admin',Rule::unique('users','email')],
            'password'=>'required|confirmed|min:6']);
        //Hash password
        $formFields['password'] = bcrypt($formFields['password']);
        //create user
        $user = User::create($formFields);
        //login
        return redirect('/admin/admin_account_create')->with('message', 'User created');
    }
    
}