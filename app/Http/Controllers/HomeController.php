<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $currentRoute;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Router $router)
    {
        $this->middleware('auth');
        $this->currentRoute = $router->currentRouteName();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Router $router)
    {
        $currentRoute = $this->currentRoute;
        $viewPath = 'home';
        $posts = Post::orderByDesc('updated_at')->get();
        if($posts->isNotEmpty())
        {
            foreach($posts as $post)
            {
                $user = Post::find($post->id)->user;
                if($user){
                    $post['author'] = $user->name;
                }
            }
            return view($viewPath, compact('posts', 'date', 'currentRoute'));
        }
        return view($viewPath, compact('currentRoute'));
    }

    public function myProfile()
    {
        $viewPath       =   'blog.my-profile';
        $currentRoute   =   $this->currentRoute;
        $authenticated  =   Auth::user();
        $posts          =   $authenticated->post;
        return view($viewPath, compact(
                'posts',
                'authenticated',
                'currentRoute'
            )
        );
    }

    public function profile($id=null)
    {
        $viewPath       =   'blog.profile';
        $authenticated  =   Auth::user();
        if($authenticated->getAuthIdentifier() == $id || !$id)
        {
            return redirect(route('my-profile'));
        }
        $currentRoute   =   $this->currentRoute;
        $user           =   User::find($id);
        if(isset($user))
        {
            $user = [
                'name' => $user->name,
                'join_at' => $user->created_at,
                'posts' => $user->post
            ];
            return view($viewPath, compact('user', 'currentRoute'));
        }
        return view($viewPath, compact('currentRoute'));
    }

    public function post($id)
    {
        $viewPath       =   'blog.post';
        $currentRoute   =   $this->currentRoute;
        $post = Post::find($id);
        if(isset($post))
        {
            $comments = $post->comment->sortByDesc('updated_at');
            if($comments->isNotEmpty())
            {
                return view($viewPath, compact('currentRoute', 'post', 'comments'));
            }
            return view($viewPath, compact('currentRoute', 'post'));
        }

        return view($viewPath, compact('currentRoute'));
    }
}
