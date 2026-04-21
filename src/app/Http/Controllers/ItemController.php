<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Item;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Favorite;
use App\Models\Category_item;
use App\Http\Requests\ExhibitionRequest;


class ItemController extends Controller
{
    //
    public function index(Request $request)
    {
        $tab = $request->query('tab');
        $search = $request->query('search');
        $query = Item::query();
        $query->where('user_id', '<>', Auth::id());

        if($tab ==='mylist'){
            if(!Auth::check()){
                $query = null;
                $items = null;
                return view('index', compact('search', 'items'));
            }
            else{
            //Favoritesテーブルからログインユーザーのいいね情報のみを抽出→更にitem_idのみを抽出
            $userFavorites = Favorite::where('user_id', auth()->id())->pluck('item_id');
            //抽出したIDに合致するItemレコードを取り出す
            $query->whereIn('id', $userFavorites);
            }
        }
        if($search){
            $query->where('name', 'like', "%{$search}%");
        }
        $items = $query->get();
        return view('index', compact('search','items'));
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
            'search' => $request->input('search'),
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
        $favoriteExists = Favorite::where('item_id', $item_id->id)->where('user_id', $user->id)->first();

        if($favoriteExists) {
            $favoriteExists->delete();

        } else {
            Favorite::create([
                'user_id' => $user->id,
                'item_id' => $item_id->id]);
        }

        return back();

    }

    public function create(ExhibitionRequest $request)
    {
        $user = auth()->user();

        $item = new Item();
        $item->user_id = $user->id;
        $item->name = $request->name;
        $item->brand = $request->brand;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->condition = $request->condition;


        $original = $request->file('image')->getClientOriginalName();
        $name = date('Ymd_His') . '_' . $original;
        $request->file('image')->move('storage/images', $name);

        $item->image = $name;

        $item->save();

        $categories = $request->category;

        foreach($categories as $category)
        {
            $categoryItem = new Category_item();
            $categoryItem->item_id = $item->id;
            $categoryItem->category_id = $category;

            $categoryItem->save();
        }

        return redirect('/')->with('message', '出品しました');
    }

    public function sellIndex()
    {
        $user = auth()->user();
        $items = Item::where('user_id', $user->id)->get();

        return view('mypage', compact('items'));
    }
}
