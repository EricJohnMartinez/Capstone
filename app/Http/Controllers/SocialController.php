<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class SocialController extends Controller
{

    public function post() {
        $social_media = SocialMedia::all();
        return view('listings.feed_post', compact('social_media'));
    }

       //add post on feed
       public function store_post (Request $request) {
        $formFields = $request->validate([
            'post'=> 'required'
       ]);
        if($request->hasFile('media')){
    $formFields['media']= $request->file('media')
    ->store('post','public');
        }
        $formFields['user_id']= auth()->id();
        SocialMedia::create($formFields);
        return redirect('/listings/feed')->with('message', "Status has been posted");
    }
}
