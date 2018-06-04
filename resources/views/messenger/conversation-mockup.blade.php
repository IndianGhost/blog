@extends('layouts.blog')

@section('style')
    <style type="text/css">
        .title{
            color: #000000bd;
        }
        .card, .card-sender, .card-receiver{
            padding: 2%;
            margin: 5% auto;
            border-bottom: 1px solid #b3b3b3;
        }
        .card:hover{
            cursor: pointer;
            opacity: 0.9;
            background-color: #eceff133;
        }
        .card-title{
            color: #428bca;
            font-size: 1em;
            font-weight: bold;
        }
        body{
            overflow-x: hidden;
        }
        .conversation {
            margin: 5% 0% 2% 0%;
        }
        .conversation-list, .conversation-messages{
            background-color: #ffffffaa;
            padding: 2% 1%;
            border-radius: 10px;
            box-shadow: 0 0 1px 0em #428bca;
        }
        .conversation-messages{
            margin-left: 2%;
        }
        .card-sender, .card-receiver{
            color: #1A237E;
            border-radius: 5px;
            margin: 5px 0 0 0;
            padding: 2% 5%;
            width: 55%;
        }
        .card-sender{
            background-color: #428bca82;
        }
        .card-receiver{
            background-color: #E0F2F1;
        }
        .message-area{
            max-width: 100%;
            min-width: 100%;
            max-height: 100px;
            min-height: 100px;
            border-color: #b3b3b3;
            padding: 1%;
        }
        .form-horizontal{
            margin-top: 5%;
        }
        .conversation-messages-container{
            display: block;
            /*height: 500px;*/
            background-color: #fff;
            padding: 2%;
            box-shadow: inset 0px 0px 2px 1px #b3b3b3;
        }
        .sent-at {
            color: #1a237ea6;
            font-style: italic;
        }
    </style>
@endsection

@section('content')
<div class="row conversation">

    <div class="col-md-offset-1 col-md-3 conversation-list">
        <div class="col-md-12">
            <h2 class="title">Conversations list</h2>
            @for($i=0; $i<5; $i++)
            <div class="card">
                <h5 class="card-title">Name Name</h5>
                <small>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod</small>
            </div>{{-- card --}}
            @endfor
        </div>
    </div>

    <div class="col-md-7 conversation-messages">
        <h1 class="title">Name Name</h1>
        <div class="col-md-12">

            <div class="conversation-messages-container row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <span class="btn">Show more messages...</span>
                            </center>
                        </div>
                    </div>

                    <div class="card-receiver pull-left">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod</p>
                        <div class="row">
                            <div class="col-md-12">
                                <small class="pull-right sent-at">4 days ago</small>
                            </div>
                        </div>
                    </div>

                    <div class="card-sender pull-right">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod</p>
                        <div class="row">
                            <div class="col-md-12">
                                <small class="pull-right sent-at">2 hours ago</small>
                            </div>
                        </div>
                    </div>

                    <div class="card-sender pull-right">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod</p>
                        <div class="row">
                            <div class="col-md-12">
                                <small class="pull-right sent-at">20 minutes ago</small>
                            </div>
                        </div>
                    </div>

                    <div class="card-receiver pull-left">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod</p>
                        <div class="row">
                            <div class="col-md-12">
                                <small class="pull-right sent-at">3 seconds ago</small>
                            </div>
                        </div>
                    </div>

                </div>

            </div>{{-- conversation-messages-container --}}

            <form class="form-horizontal">
                <textarea type="text"
                          placeholder="Message..."
                          class="message-area"
                ></textarea>
                <input type="submit"
                       value="send message"
                       class="btn btn-primary pull-right"
                />
            </form>

        </div>

    </div>{{-- conversation-messages --}}

</div>{{-- conversation --}}
@endsection