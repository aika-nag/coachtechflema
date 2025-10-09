<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Item;

class CommentController extends Controller
{
    //
    public function store(Item $item_id, Request $request)
    {
        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->item_id = $item_id->id;
        $comment->content = $request->content;

        $comment->save();

        $comments = Comment::where('item_id', $item_id->id)->get();

        $data = [
            'input' => $request->input('search'),
            'item' => $item_id,
            'comments' => $comments
        ];

        return view('item', $data);
    }
}
