@extends('layouts.blog')

@section('content')
<div class="row conversation">

    <div class="col-md-offset-1 col-md-3 conversation-list">
        <div class="col-md-12">
            <h2 class="title title-conversation">Conversations list</h2>
            @foreach($conversations_list as $demo)

                <a href="{{ route('conversation', $demo['friend_id']) }}">

                    <div class="card {{ $demo['friend_id']==$friend->id? 'card-active' : '' }}">

                        <h5 class="card-title {{ $demo['friend_id']==$friend->id? 'card-title-active' : '' }}">
                            {{ $demo['name'] }}
                        </h5>

                        <small>
                            {{ $demo['is_sender'] ? '' :'->' }}
                            {{ substr($demo['last_message'], 0, 50) }}...
                        </small>

                        <div class="row">
                            <small class="pull-right sent-at">
                                {{ $demo['sent_at']->diffForHumans() }}
                            </small>
                        </div>

                    </div>{{-- card --}}

                </a>
            @endforeach
        </div>
    </div>

    <div class="col-md-7 conversation-messages">
        @include('blog.includes.errors')
        <h1 class="title title-conversation">
            <a href="{{ route('profile', $friend->id) }}">{{ $friend->name }}</a>
        </h1>
        <div class="col-md-12">

            <div class="conversation-messages-container row">
                <div class="col-md-12">
                    @if($conversation->isNotEmpty())
                        <div class="row">
                            <div class="col-md-12">
                                <center>
                                    <span class="btn">Show more messages...</span>
                                </center>
                            </div>
                        </div>
                    @endif

                    @forelse($conversation as $message)
                        <div class="{{ $message->sender->id == Auth::user()->id? 'card-sender pull-right' : 'card-receiver pull-left'}}">

                            <p>
                                {{ $message->content }}
                            </p>

                            <div class="row">
                                <div class="col-md-12">
                                    <small class="pull-right sent-at">
                                        {{ $message->created_at->format('M d, Y h:m:s') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="row">
                            <div class="col-md-12">
                                <span class="say-hello">Say Hello to {{$friend->name}} ;)</span>
                            </div>
                        </div>
                    @endforelse

                </div>

            </div>{{-- conversation-messages-container --}}
            <div class="row">
                <form class="form-horizontal" method="post" action="{{ route('messageStore') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="sender_id" value="{{ Auth::user()->id }}"/>
                    <input type="hidden" name="receiver_id" value="{{ $friend->id }}"/>
                    <textarea type="text"
                              name="content"
                              placeholder="Message..."
                              class="message-area"
                              required
                              autofocus
                    >{{ old('content') }}</textarea>
                    <input type="submit"
                           value="send message"
                           class="btn btn-primary pull-right"
                    />
                </form>
            </div>

        </div>

    </div>{{-- conversation-messages --}}

</div>{{-- conversation --}}
@endsection