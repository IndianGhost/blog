<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Comment;
use App\Post;

class CommentController extends HomeController
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Comment::$rules);
        $post_id = Post::find(Input::get('post_id'));
        if($validator->fails())
        {
            return redirect(route('post', $post_id))->withErrors($validator->messages());
        }
        else
        {
            Comment::create($request->all());
            return redirect(route('post', $post_id));
        }
    }
}