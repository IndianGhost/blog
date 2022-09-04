<?php

namespace App\Http\Controllers;

use App\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Log;

class PostController extends HomeController {

    const ALERT_CREATE_SUCCESS = 'Your post has been added successfully !';
    const ALERT_UPDATE_SUCCESS = 'Your post has been updated successfully !';
    const ALERT_DELETE_SUCCESS = 'Your post has been deleted successfully !';
    const ALERT_DELETE_FAIL = 'Oooops! There\'s something wrong, try to delete this post later.';

    private PostService $postService;

    public function __construct(Router $router, PostService $postService) {
        parent::__construct($router);
        $this->postService = $postService;
    }

    public function add() {
        $currentRoute = $this->currentRoute;
        $viewPath = 'blog.add-post';
        return view($viewPath, compact('currentRoute'));
    }

    public function store(Request $request) {
        $validator = $this->postService->validator($request->all());
        if ($validator->fails()) {
            return redirect(route('postAdd'))
                            ->withErrors($validator->messages())
                            ->withInput($request->input())
            ;
        } else {
            $this->postService->create($request->all());
            return redirect(route('my-profile'))->with([
                        'alert' => $this::ALERT_CREATE_SUCCESS
            ]);
        }
    }

    public function edit($id) {
        $currentRoute = $this->currentRoute;
        $viewPath = 'blog.edit-post';
        $post = Post::find($id);
        return $post ? view($viewPath, compact('id', 'post', 'currentRoute')) :
                redirect(route('home'));
    }

    public function update(Request $request, $id) {
        $validator = $this->postService->validator($request->all());
        $post = Post::find($id);
        if ($validator->fails()) {
            return redirect(route('postEdit', [$id]))
                            ->withErrors($validator->messages())
                            ->withInput([$post]);
        } else {
            $this->postService->update($id, $request->all());
            return redirect(route('my-profile'))->with([
                        'alert' => $this::ALERT_UPDATE_SUCCESS
            ]);
        }
    }

    public function delete($id) {
        try {
            $this->postService->delete($id);
            $alert = $this::ALERT_DELETE_SUCCESS;
        } catch (Exception $ex) {
            Log::info($ex->getMessage());
            $alert = $this::ALERT_DELETE_FAIL;
        }
        return $alert ? redirect(route('my-profile'))->with([$alert]) :
                redirect(route('my-profile'));
    }

}
