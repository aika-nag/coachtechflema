<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    //
    public function index(Request $request)
    {
        $profile = Profile::class;
        $input = $request->input('search');
        return view('profile', compact('input'));
    }

    public function store(Request $request)
    {
        $profile = new Profile();
        $profile->name= $request->name;
        $profile->zipcode= $request->zipcode;
        $profile->address= $request->profile;
        $profile->building= $request->building;

        if(request('image')){
            $original = request()->file('image')->getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            request()->file('image')->move('storage/images', $name);
            $profile->image = $name;
        }

        $profile->save();

    }

}
