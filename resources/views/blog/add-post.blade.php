@extends('layouts.blog')

@section('style')
    <style type="text/css">
        .container{
            margin-bottom: 2%;
        }
        @media only screen and (max-width: 800px){
            .container{
                width: 90%;
            }
        }
    </style>
@endsection

@section('content')

    <div class="container">

        <div class="page-header container">
            <h1 class="title">Add a post</h1>
            <p>Author : {{ Auth::user()->name }}</p>
        </div>

        @include('blog.includes.errors')

        <form class="form-horizontal" action="{{ route('postStore') }}" method="post">
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
                        value="{{ old('title') }}"
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
                >{{ old('content') }}</textarea>
            </div>
            <div class="form-group">
                <center>
                    <input type="submit"
                           value="Add post"
                           class="btn btn-primary btn-add-post"
                    />
                    <input type="reset"
                           value="Cancel"
                           class="btn btn-primary btn-cancel-post"
                    />
                </center>
            </div>
        </form>
    </div>
@endsection