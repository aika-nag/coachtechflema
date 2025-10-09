<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Item;

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
        $user = auth()->user();

        $profile = new Profile();
        $profile->user_id = $user->id;
        $profile->name = $request->name;
        $profile->zipcode = $request->zipcode;
        $profile->address = $request->address;
        $profile->building = $request->building;

        if($request->hasFile('image')) {
            $original = $request->image->getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            $path = $request->file('image')->move('storage/images', $name);
            $profile->image = $path;
        }

        $profile->save();

        $input = '';
        $items = Item::all();

        return redirect('/');

    }

    public function changeAddress(Item $item)
    {
        $data = [
            'item' => $item,
        ];
        return view('address', $data);
    }

    public function update(Request $request, Item $item)
    {
        $user = auth()->user;

        $form = $request->all();
        unset($form['token']);
        Profile::where('user_id', $user->id)->first()->update($form);

        $data = [
            'item' => $item
        ];

        return redirect('/purchase/{{{ $item->id} }}}', compact('data'));
    }

}
