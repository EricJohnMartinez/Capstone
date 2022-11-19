<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PhpParser\Node\Expr\List_;

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

        if($listing->user_id != auth()->id()){
            abort(403,'Unauthorized Action');
        }

        $formFields = $request->validate([
            'title'=> 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required' ,'email'],
            'tags' => 'required',
            'descript' => 'required'
        ]);
        if($request->hasFile('logo')){
        $formFields['logo']= $request->file('logo')
        ->store('logos','public');
        }
        $listing->update($formFields);
        return back()->with('message', "Job Updated");
    }

    public function destroy(Listing $listing){
        if($listing->user_id != auth()->id()){
            abort(403,'Unauthorized Action');
        }
        $listing->delete();
        return redirect('/')->with('message', "Job listed has been deleted successfully");
    }

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
    return redirect('/')->with('message', "Announcement has been posted");
}


}

