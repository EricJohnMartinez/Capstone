<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use GuzzleHttp\Middleware;
use App\Models\Announcement;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\List_;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    public function index(){
        return view('listings.index', [
            'list'=> Listing::latest()->
            filter(request(['tag','search']))->paginate(10)
        ]);
    }

    public function show(Listing $listing){
        return view ('listings.show',[
            'listing'=> $listing
        ]);
    }

    public function create() {
        return view('listings.create');
    }

    public function store(Request $request){
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
        if(Auth::user()->role =='admin'){
        return redirect('/admin/admin_job')->with('message', "Job has been posted");
        }
        return redirect('/')->with('message', "Job has been posted");
    }
   
    public function calendar() {
        return view('listings.calendar');
    }

    public function feed() {
        return view('listings.feed');
    }

 

    public function job() {
        return view('listings.job', [
            'list'=> Listing::latest()->
            filter(request(['tag','search']))->paginate(10)
        ]);
    }

    public function edit(Listing $listing) {
        return view('listings.edit',['listing'=>$listing]);
    }

    public function update(Request $request, Listing $listing){

        if($listing->user_id == auth()->id()||Auth::user()->role =='admin'){
            $formFields = $request->validate([
                'title'=> 'required',
                'company' => ['required'],
                'location' => 'required',
                'email' => ['required' ,'email'],
                'tags' => 'required',
                'descript' => 'required'
            ]);
            if($request->hasFile('logo')){
                $formFields['logo']= $request->file('logo')
                ->store('logos','public');
                }
                $listing->update($formFields);
                if(Auth::user()->role =='admin'){
                return redirect('/admin/admin_job')->with('message', "Job Updated");
                }
                return back()->with('message', "Job Updated");
          //abort(403,'Unauthorized Action');
        }
        abort(403,'Unauthorized Action');
      

    }

    public function destroy(Listing $listing){
        if($listing->user_id == auth()->id()||Auth::user()->role =='admin'){
            $listing->delete();
            if(Auth::user()->role =='admin'){
            return redirect('/admin/admin_job')->with('message', "Job listed has been deleted successfully");
            }
            return redirect('/')->with('message', "Job listed has been deleted successfully");
        }
        else
        abort(403,'Unauthorized Action');
    }
    //Auth::user()->role =='admin'

  

    //manage listings

    public function manage(){
        return view('listings.manage',
        ['listings'=>auth()
        ->user()->listings()->get()]);
    }

//show announcement
public function create_announcement() {
    return view('listings.create_announcement');
}

//create announcement
public function store_announcement(Request $request){
    $formFields = $request->validate([
        'title'=> 'required',
        'tags' => 'required',
        'descript' => 'required'
    ]);
    if($request->hasFile('media')){
$formFields['media']= $request->file('media')
->store('medias','public');
    }
    $formFields['user_id']= auth()->id();
    Announcement::create($formFields);
    return redirect('/admin/admin_announcement')->with('message', "Announcement has been posted");
}





//show job application form
public function job_apply() {
    return view('listings.job_apply');
}


}


