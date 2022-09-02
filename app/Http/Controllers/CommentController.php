<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Comment;
use App\Post;

class CommentController extends HomeController
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Comment::$rules);
        $post_id = Post::find(Request::input('post_id'));
        if($validator->fails())
        {
            return redirect(route('post', $post_id))
                ->withErrors($validator->messages())
                ->withInput($request->input())
            ;
        }
        else
        {
            Comment::create($request->all());
            return redirect(route('post', $post_id));
        }
    }
}