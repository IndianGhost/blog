@extends('layouts.blog')

@section('style')
    <style type="text/css">
    </style>
@endsection

@section('content')
    @if(isset($user))
    <header class="page-header container">

        <h1 class="title">{{ $user['name'] }}'s profile</h1>
        <p class="lead">
            Welcome {{ Auth::user()->name }}!
        </p>

    </header>

    <div class="container">

        <table class="table">
            <thead>
                <tr>
                    <th colspan="2" class="title table-title text-center">General Informations</th>
                </tr>
            </thead>
            <tbody class="text-right">
                <tr>
                    <th>Name</th>
                    <td>{{ $user['name'] }}</td>
                </tr>
                <tr>
                    <th>Join us</th>
                    <td>{{ $user['join_at']->diffForHumans() }}</td>
                </tr>
            </tbody>
        </table>

        <div class="page-header container">
            <h1 class="title">{{ $user['name'] }}'s posts</h1>
        </div>

            @forelse($user['posts'] as $post)

                <div class="blog-post">
                    <h2 class="blog-post-title">
                        <a href="{{ route('post', $post->id) }}">
                            {{ $post->title }}
                        </a>
                    </h2>
                    <p class="blog-post-meta">
                        {{ $post->created_at->format('M d, Y') }} by <a href="#">{{ $user['name'] }}</a>
                        @if($post->created_at != $post->updated_at)
                            , (last update {{ $post->updated_at->format('M d, Y') }})
                        @endif
                    </p>

                    <p>{{ $post->content }}</p>
                    <hr>
                </div><!-- /.blog-post -->

            @empty

                <p class="lead text-center">
                    Unfortunately, {{ $user['name'] }} didn't write any post yet !
                </p>

            @endforelse

    </div>
    @else
        <header class="page-header container">

            <h1 class="title">Ooooops !</h1>
            <p class="lead">
                You're trying to reach an unexisting profile, You can go back <a href="{{ route('home') }}" title="click here to reach the main page">HOME</a> !
            </p>

        </header>
    @endif
@endsection