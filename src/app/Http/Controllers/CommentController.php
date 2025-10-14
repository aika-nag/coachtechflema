<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Item;
use App\Http\Requests\CommentRequest;
use App\Models\Profile;

class CommentController extends Controller
{
    //
    public function store(Item $item_id, CommentRequest $request)
    {
        $user = auth()->user();
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->item_id = $item_id->id;
        $comment->content = $request->content;

        $comment->save();

        $comments = Comment::where('item_id', $item_id->id)->get();

        $profile = Profile::where('user_id', $user->id)->first();

        $data = [
            'input' => $request->input('search'),
            'item' => $item_id,
            'comments' => $comments,
            'profile' => $profile
        ];

        return view('item', $data);
    }
}
