@extends('layouts.blog')

@section('content')
<div class="container">

    <div class="blog-header">
        <h1 class="blog-title">{{ config('app.name', 'Blog') }}</h1>
        <p class="lead blog-description">The official example template of creating a blog with Bootstrap.</p>
    </div>

    <div class="row">
    @if($pagination AND $posts->isNotEmpty())
        <div class="col-sm-8 blog-main">
            @for($i = $pagination['firstIndex']; $i <= $pagination['lastIndex']; $i++)
            <div class="blog-post">
                <h2 class="blog-post-title">
                    {{ $posts[$i]->title }}
                </h2>
                <p class="blog-post-meta">
                    {{ $posts[$i]->created_at->format('M d, Y') }} by <a href="{{ route('profile', $posts[$i]->user_id) }}">{{ $posts[$i]->user->name}}</a>
                    @if($posts[$i]->created_at != $posts[$i]->updated_at)
                        , (last update {{ $posts[$i]->updated_at->format('M d, Y') }})
                    @endif
                </p>

                <p>
                    {{ substr($posts[$i]->content, 0, 255) }}...<a href="{{ route('post', $posts[$i]->id) }}">Read more</a>
                </p>
                <hr>
            </div><!-- /.blog-post -->
            @endfor

            <nav>
                <ul class="pager">
                    @if($pagination['isNotFirst'])
                        <li><a href="{{ url('/', $pagination['currentPage']-1)}}">Previous</a></li>
                    @endif
                    @if($pagination['isNotLast'])
                        <li><a href="{{ url('/', $pagination['currentPage']+1)}}">Next</a></li>
                    @endif
                </ul>
            </nav>
        @else
            <p class="lead">
                This page doesn't exist !
            </p>
        @endif

        </div><!-- /.blog-main -->

        @include('blog.includes.blog-sidebar')

    </div><!-- /.row -->

</div><!-- /.container -->
@endsection