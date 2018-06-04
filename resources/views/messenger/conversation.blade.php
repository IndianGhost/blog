@extends('layouts.blog')

@section('content')
    @forelse($conversation as $message)
    <div class="row">
        <div class="{{ $message->sender_id == Auth::user()->id? 'col-md-offset-6': ''}} col-md-6">
            <p>
                {{ $message->content }}
                <small>sent : {{ $message->created_at->diffForHumans() }}</small>
            </p>
        </div>
    </div>
    @empty
        <p>You have any message yet with this member !</p>
    @endforelse

@endsection