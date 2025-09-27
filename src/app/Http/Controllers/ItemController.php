<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Item;
use App\Models\CategoryItem;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\User;

class ItemController extends Controller
{
    //
    public function index(Request $request)
    {
        $input = $request->input('search');
        $items = Item::all();
        return view('index', compact('input','items'));
    }

    public function detail(Item $item_id, Request $request)
    {
        $data = [
            'input' => $request->input('search'),
            'item' => $item_id
        ];
        return view('item', $data);
    }

    public function search(Request $request)
    {
        $items = Item::where('name', 'LIKE', "%{$request->input('search')}%")->get();
        $param = [
            'input' => $request->input('search'),
            'items' => $items
        ];

        return view('index', $param);
    }

    public function sell(Request $request)
    {
        $input = $request->input('search');
        return view('sell', compact('input'));
    }

    public function favorite(Item $item_id)
    {
        $user = auth()->user();
        $existingFavorite = Favorite::where('item_id', $item_id->id)->where('user_id', $user->id)->first();

        if($existingFavorite) {
            $existingFavorite->delete();

        } else {
            Favorite::create([
                'user_id' => $user->id,
                'item_id' => $item_id->id]);
        }

        return back();

    }

    public function mylist(Request $request)
    {
        $user = auth()->user();
        $favoriteitems = $user->favorites()->get();

        $mylist = [
            'input' => $request->input('search'),
            'items' => $favoriteitems,
            'param' => $request->tab
        ];

        return view('index', $mylist);
    }

}
