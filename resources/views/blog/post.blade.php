@extends('layouts.blog')

@section('content')
@if(isset($post))
    <div class="container">

        <div class="blog-header">
            <h1 class="blog-title">{{ config('app.name', 'Blog') }}</h1>
            <p class="lead blog-description">The official example template of creating a blog with Bootstrap.</p>
        </div>

        <div class="row">

            <div class="col-sm-8 blog-main">
                @include('blog.includes.errors')

                <div class="blog-post">
                    <h2 class="blog-post-title">
                        <a href="{{ route('home') }}">
                            {{ $post->title }}
                        </a>
                    </h2>
                    <p class="blog-post-meta">
                        {{ $post->created_at->format('M d, Y') }} by <a href="{{ route('profile', $post->user_id) }}">{{ $post->user->name}}</a>
                        @if($post->created_at != $post->updated_at)
                            , (last update {{ $post->updated_at->diffForHumans() }})
                        @endif
                    </p>

                    <p>{{ $post->content }}</p>
                    <hr>
                    @if($post->user->id == Auth::user()->id)
                        <a href="{{ route('postEdit', $post->id) }}" class="btn btn-primary">
                            Edit
                        </a>
                    @endif
                </div><!-- /.blog-post -->
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('commentCreate') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden"
                                   name="user_id"
                                   value="{{ Auth::user()->id }}"
                            />
                            <input type="hidden"
                                   name="post_id"
                                   value="{{ $post->id }}"
                            />
                            <div class="form-group">
                                <label for="comment">{{ Auth::user()->name }}</label>
                                <textarea class="form-control comment"
                                       id="comment"
                                       name="content"
                                       placeholder="Your comment here..."
                                      required
                                >{{ old('content') }}</textarea>
                            </div>
                            <input
                                    class="btn btn-primary pull-right"
                                    type="submit"
                                    value="Submit"
                            />
                        </form>
                    </div>
                </div>
                @if(isset($comments))
                    @foreach($comments as $comment)
                        <div class="row">
                            <div class="col-md-12">
                                <h1>
                                    <a href="{{ route('profile', $comment->user->id) }}">
                                        {{ $comment->user->name }}
                                    </a>
                                </h1>
                                <p>
                                    {{ $comment->content }}
                                </p>
                                <small class="pull-right">
                                    {{ $comment->created_at->diffForHumans() }}
                                    @if($comment->created_at != $comment->updated_at)
                                        , (last update {{ $comment->updated_at->diffForHumans() }})
                                    @endif
                                </small>
                            </div>
                        </div>
                        <hr/>
                    @endforeach
                @else
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-center">
                                No comment yet !
                            </p>
                        </div>
                    </div>
                @endif
            </div><!-- /.blog-main -->

            @include('blog.includes.blog-sidebar')

        </div><!-- /.row -->

    </div><!-- /.container -->
@else
    <header class="page-header container">

        <h1 class="title">Ooooops !</h1>
        <p class="lead">
            You're trying to reach an unexisting post, You can go back <a href="{{ route('home') }}" title="click here to reach the main page">HOME</a> !
        </p>

    </header>
@endif
@endsection