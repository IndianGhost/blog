@extends('layouts.blog')

@section('content')
<div class="container">

    <div class="blog-header">
        <h1 class="blog-title">{{ config('app.name', 'Blog') }}</h1>
        <p class="lead blog-description">The official example template of creating a blog with Bootstrap.</p>
    </div>

    <div class="row">

        <div class="col-sm-8 blog-main">
            @foreach($posts as $post)
            <div class="blog-post">
                <h2 class="blog-post-title">
                    <a href="{{ route('post', $post->id) }}">
                        {{ $post->title }}
                    </a>
                </h2>
                <p class="blog-post-meta">
                    {{ $post->created_at->format('M d, Y') }} by <a href="{{ route('profile', $post->user_id) }}">{{ $post->author}}</a>
                    @if($post->created_at != $post->updated_at)
                        , (last update {{ $post->updated_at->format('M d, Y') }})
                    @endif
                </p>

                <p>{{ $post->content }}</p>
                <hr>
            </div><!-- /.blog-post -->
            @endforeach

            <nav>
                <ul class="pager">
                    <li><a href="#">Previous</a></li>
                    <li><a href="#">Next</a></li>
                </ul>
            </nav>

        </div><!-- /.blog-main -->

        @include('blog.includes.blog-sidebar')

    </div><!-- /.row -->

</div><!-- /.container -->
@endsection