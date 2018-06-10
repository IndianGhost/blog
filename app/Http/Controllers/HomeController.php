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

    /*
     * Cette methode sera reeutilisee dans autres vues
     * Pagination : le role de cette methode est de calculer :
     *  - Le nombre total des pages a paginer
     *  - Le numero de la page courante
     *  - Les indices des posts qui devraient etre affiches dans la page courante
     *  - Les indices seront extraits du tableau contenant les posts et non pas les id de la base de donnees
     */
    protected function pagination($currentPage, $data, $postPerPage = 4)
    {
        $pagination = null;
        //total number of records
        $countData  =   count($data);

        //total pages
        $totalPages =   ceil( $countData / $postPerPage );

        if($currentPage <= $totalPages && $currentPage>0)
        {
            $firstIndex =   $postPerPage * ($currentPage-1);
            $lastIndex  =   $currentPage == $totalPages
                            ?   $countData - 1
                            :   $currentPage * $postPerPage -1;
            $isNotFirst =   ($currentPage != 1);
            $isNotLast  =   ($currentPage != $totalPages);

            $pagination = [
                'currentPage'   =>  $currentPage,
                'totalPages'    =>  $totalPages,
                'firstIndex'    =>  $firstIndex,
                'lastIndex'     =>  $lastIndex,
                'isNotFirst'    =>  $isNotFirst,
                'isNotLast'    =>   $isNotLast
            ];
        }
        return $pagination;
    }

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
    public function index($page=1)
    {
        $viewPath       =   'home';
        $currentRoute   =   $this->currentRoute;
        $posts          =   Post::orderByDesc('updated_at')->get();
        $pagination     =   $this->pagination($page, $posts);

        if($posts->isNotEmpty())
        {
            return $pagination ?
                view($viewPath, compact('posts', 'currentRoute', 'pagination'))
                :
                redirect( route('home') )
            ;
        }

        return view($viewPath, compact('currentRoute'));
    }

    public function myProfile()
    {
        $viewPath       =   'blog.my-profile';
        $currentRoute   =   $this->currentRoute;
        $authenticated  =   Auth::user();
        $posts          =   $authenticated->post->sortByDesc('updated_at');
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
                'posts' => $user->post->sortByDesc('updated_at')
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
