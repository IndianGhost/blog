@extends('layouts.blog')

@section('style')
    <style type="text/css">
        .container{
            margin-bottom: 2%;
        }
    </style>
@endsection

@section('content')

    <div class="container">

        <div class="page-header container">
            <h1 class="title">Edit : <em>{{ $post->title }}</em></h1>
            <p>Author : {{ Auth::user()->name }}</p>
        </div>

        @include('blog.includes.errors')

        <form class="form-horizontal" action="{{ route('postUpdate', $post->id) }}" method="post">
            {{ csrf_field() }}
            <input type="hidden"
                   name="user_id"
                   value="{{ Auth::user()->id }}"
            />
            <div class="form-group">
                <label for="title">Title</label>
                <input  type="text"
                        name="title"
                        id="title"
                        class="form-control"
                        placeholder="Title..."
                        value="{{ $post->title }}"
                        autofocus
                        required
                />
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control post-content"
                          name="content"
                          id="content"
                          cols="30"
                          rows="10"
                          placeholder="Content..."
                          required
                >{{ $post->content }}</textarea>
            </div>
            <div class="form-group">
                <input type="submit"
                       value="Edit post"
                       class="btn btn-primary"
                />
            </div>
        </form>
    </div>
@endsection