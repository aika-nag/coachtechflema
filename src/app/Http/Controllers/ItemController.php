<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Item;
use App\Models\CategoryItem;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Favorite;
use App\Models\User;
use App\Models\Profile;
use App\Models\Category_item;
use App\Models\Order;

class ItemController extends Controller
{
    //
    public function index(Request $request)
    {
        $input = '';
        $items = Item::all();
        return view('index', compact('input','items'));
    }

    public function detail(Item $item_id, Request $request)
    {
        $comments = Comment::where('item_id', $item_id->id)->get();

        $data = [
            'input' => $request->input('search'),
            'item' => $item_id,
            'comments' => $comments
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
        $categories = Category::all();
        $input = $request->input('search');
        return view('sell', compact('input', 'categories'));
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
        //ログイン中のユーザーidを取得
        $user = auth()->user();

        if ($user != null) {
        //Favoritesテーブルからログインユーザーのいいね情報のみを抽出→更にitem_idのみを抽出
        $userfavorites = Favorite::where('user_id', $user->id)->get()->pluck('item_id');
        //抽出したIDに合致するItemレコードを取り出す
        $favoriteitems = Item::find($userfavorites);

        $mylist = [
            'input' => $request->input('search'),
            'items' => $favoriteitems,
        ];

        return view('index', $mylist);
    }
        else {
        $data = [
            'items' => null,
            'input' => ''
        ];
            return view('index', $data);
        }

    }

    public function purchase(Item $item)
    {
        $user = auth()->user();

        $address = Profile::where('user_id', $user->id)->first();

        $data = [
            'item' => $item,
            'profile' => $address
        ];

        return view('purchase', $data);

    }

    public function ajax(Request $request)
    {
        $ajax = $request->payment;

        return response()->json([
            'form' => view('purchase')->with(['payment_data' => $ajax])->render()
        ]);
    }

    public function create(Request $request)
    {
        $user = auth()->user();

        $Item = new Item();
        $Item->user_id = $user->id;
        $Item->name = $request->name;
        $Item->brand = $request->brand;
        $Item->description = $request->description;
        $Item->price = $request->price;
        $Item->condition = $request->condition;


        $original = $request->file('image')->getClientOriginalName();
        $name = date('Ymd_His') . '_' . $original;
        $request->file('image')->move('storage/images', $name);

        $Item->image = $name;

        $Item->save();

        $categories = $request->category;

        foreach($categories as $category)
        {
            $category_item = new Category_item();
            $category_item->item_id = $Item->id;
            $category_item->category_id = $category;

            $category_item->save();
        }

        $input = '';
        $items = Item::all();

        return redirect('/')->with('message', '出品しました');
    }

    public function sell_index()
    {
        $user = auth()->user();
        $items = Item::where('user_id', $user->id)->get();

        return view('mypage', compact('items'));
    }

    public function order(Request $request, Item $item_id)
    {
        $user = auth()->user();

        $Order = new Order();
        $Order->user_id = $user->id;
        $Order->item_id = $item_id->id;
        $Order->payment = $request->hidden_payment;
        $Order->delivery_zipcode = $request->hidden_zipcode;
        $Order->delivery_address = $request->hidden_address;
        $Order->delivery_building = $request->hidden_building;

        $Order->save();
        
        return redirect('/');
    }
}
