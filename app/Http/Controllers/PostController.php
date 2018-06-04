<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Post;

class PostController extends HomeController
{
    public function add()
    {
        $currentRoute = $this->currentRoute;
        $viewPath = 'blog.add-post';
        return view($viewPath, compact('currentRoute'));
    }

    public function store(Request $request)
    {
        $validator  =   Validator::make($request->all(), Post::$rules);
        if($validator->fails())
        {
            return redirect( route('postAdd') )
                ->withErrors($validator->messages())
                ->withInput($request->input())
            ;
        }
        else
        {
            Post::create($request->all());
            return redirect( route('my-profile') )->with([
                'alert'=>'Your post has been added successfully !'
            ]);
        }
    }

    public function edit($id)
    {
        $viewPath   =   'blog.edit-post';
        $post       =   Post::find($id);
        if($post)
        {
            return view($viewPath, compact('id', 'post'));
        }
        return redirect(route('home'));
    }

    public function update(Request $request, $id)
    {
        $post       =   Post::find($id);
        $validator  =   Validator::make($request->all(), Post::$rules);
        if($validator->fails())
        {
            return redirect( route('postEdit') )
                ->withErrors($validator->messages())
                ->withInput($post)
            ;
        }
        else
        {
            $post->update($request->all());
            return redirect( route('my-profile') )->with([
                'alert'=>'Your post has been updated successfully !'
            ]);
        }
    }
}