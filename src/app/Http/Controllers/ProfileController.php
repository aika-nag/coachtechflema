<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Item;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;

use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    //
    public function index(Request $request)
    {
        $user = auth()->user();
        $profile = Profile::where('user_id', $user->id)->first();
        $input = $request->input('search');
        return view('profile', compact('input', 'profile'));
    }

    public function store(ProfileRequest $request)
    {
        $user = auth()->user();
        $profileExists = Profile::where('user_id', $user->id)->first();
        if($profileExists) {

            if ($request->hasFile('image')) {
                $original = $request->image->getClientOriginalName();
                $name = date('Ymd_His') . '_' . $original;
                $path = $request->file('image')->move('storage/images', $name);
                Storage::disk('public')->delete('images/'. $profileExists->image);
                $profileExists->update(['image' => $name ]);
            }
            $profileExists->update([
                'user_id' => $user->id,
                'name' => $request->name,
                'zipcode' => $request->zipcode,
                'address' => $request->address,
                'building' => $request->building
            ]);
            return redirect('/mypage');
        } else {
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
                $profile->image = $name;
            }

            $profile->save();

            $input = '';
            $items = Item::all();

            return redirect('/');
        }
    }

    public function myPage(Request $request)
    {
        $user = auth()->user();
        $profile = Profile::where('user_id', $user->id)->first();
        $input = $request->input('search');

        $items = Item::where('user_id', $user->id)->get();

        return view('mypage', compact('profile', 'input', 'items'));
    }

    public function sellBuyItem(Request $request)
    {
        $user = auth()->user();
        $profile = Profile::where('user_id', $user->id)->first();
        $input = $request->input('search');
        $param = $request->page;

        if ($param == "sell") {
            $items = Item::where('user_id', $user->id)->get();

            return view('mypage', compact('profile', 'input', 'items'));
        }
        else {
            $buy_items = Order::where('buyer_id', $user->id)->get()->pluck('item_id');
            $items = Item::find($buy_items);

            return view('mypage', compact('profile', 'input', 'items'));
        }
    }

}
