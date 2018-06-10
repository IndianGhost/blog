@extends('layouts.blog')

@section('style')
    <style type="text/css">
        .container{
            margin-bottom: 2%;
        }
    </style>
@endsection

@section('content')
    <header class="page-header container">

        <h1 class="title">My profile</h1>
        <p class="lead">
            Welcome {{ $authenticated->name }} !
        </p>

    </header>

    <div class="container">
        @if( Session::get('alert') )
            <div class="alert alert-success">
                {{ Session::get('alert') }}
            </div>
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                    <th colspan="2" class="title table-title text-center">General Informations</th>
                </tr>
            </thead>
            <tbody class="text-right">
                <tr>
                    <th>Name</th>
                    <td>{{ $authenticated->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $authenticated->email }}</td>
                </tr>
                <tr>
                    <th>Created at</th>
                    <td>{{ $authenticated->created_at->diffForHumans() }}</td>
                </tr>
                <tr>
                    <th>Updated at</th>
                    <td>{{ $authenticated->updated_at->diffForHumans() }}</td>
                </tr>
            </tbody>
        </table>

        <div class="row">
            <div class="col-md-12">
                <center>
                    <a href="{{ route('postAdd') }}" class="btn btn-info">
                        Add a new post
                    </a>
                </center>
            </div>
        </div>

        <div class="page-header container">
            <h1 class="title">My posts</h1>
        </div>

            @forelse($posts as $post)
                <div class="blog-post">
                    <h2 class="blog-post-title">
                        <a href="{{ route('post', $post->id) }}">
                            {{ $post->title }}
                        </a>
                    </h2>
                    <p class="blog-post-meta">
                        {{ $post->created_at->format('M d, Y') }} by <a href="#">{{ Auth::user()->name }}</a>
                        @if($post->created_at != $post->updated_at)
                            , (last update {{ $post->updated_at->diffForHumans() }})
                        @endif
                    </p>

                    <p>{{ $post->content }}</p>

                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('postEdit', $post->id) }}" class="btn btn-info">
                                Edit
                            </a>
                            <a href="{{ route('postDelete', $post->id) }}" class="btn btn-danger js-delete-post">
                                Delete
                            </a>
                        </div>
                    </div>

                    <hr>
                </div><!-- /.blog-post -->
            @empty
                <p class="lead text-center">
                    Unfortunately, you didn't write any post yet !
                </p>
            @endforelse
    </div>
@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){
        $('.js-delete-post').click(function (e) {
            e.preventDefault();
            var confirmed = confirm('This post will be deleted definitively. Are you sure you want to continue?');
            if(confirmed){
                window.location = this.getAttribute('href');
            }
        });
    });
</script>
@endsection