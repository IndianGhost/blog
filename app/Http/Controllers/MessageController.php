<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\User;
use Illuminate\Support\Facades\Validator;

class MessageController extends HomeController
{
    protected function removeOccurrenceByName(Collection $collection)
    {
        $result     =   new Collection();
        foreach($collection as $i => $item)
        {
            $occurrence = false;
            for($j = $i-1; $j>=0; $j--)
            {
                if($item['name']==$collection[$j]['name'])
                {
                    $occurrence = true;
                    break;
                }
            }
            if($occurrence)
            {
                continue;
            }
            else
            {
                $result->push($item);
            }
        }
        return $result;
    }

    public function conversation($id)
    {
        $viewPath   =   'messenger.conversation';
        $auth       =   Auth::user();

        if(!$id || $id==$auth->id){
            return redirect( route('my-profile') );
        }

        $messages   =   Message::where('sender_id', $auth->id)
            ->orWhere('receiver_id', $auth->id)
            ->get()
        ;

        $messages_receiver   =   Message::where('sender_id', $id)
            ->orWhere('receiver_id', $id)
            ->get()
        ;

        $friend             =   User::find($id);

        $conversation       =   $messages->intersect($messages_receiver);

        $conversations_list     =   new Collection();
        $demo_conversation      =   [];

//        foreach($messages as $message)
        for($i = $messages->count()-1; $i>=0; $i--)
        {
            $demo_conversation['message_id']   =    $messages[$i]->id;
            $demo_conversation['friend_id']    =   $messages[$i]->sender->id == $auth->id
                                            ?
                $messages[$i]->receiver->id
                                            :
                $messages[$i]->sender->id
            ;
            $demo_conversation['name']  =   $messages[$i]->sender->id == $auth->id
                                            ?
                $messages[$i]->receiver->name
                                            :
                $messages[$i]->sender->name
            ;
            $demo_conversation['last_message'] =   $messages[$i]->content;
            $demo_conversation['sent_at']      =   $messages[$i]->created_at;
            $demo_conversation['is_sender']    =    $messages[$i]->sender->id == $auth->id? true: false;
            $conversations_list->push($demo_conversation);
        }
//        dd($conversations_list);
        $conversations_list = $this->removeOccurrenceByName($conversations_list);
        return view($viewPath, compact('conversations_list', 'conversation', 'friend'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Message::$rules);

        if($validator->fails())
        {
            return redirect( route( 'conversation', $request->get('receiver_id') ) )
                ->withErrors($validator->messages())
                ->withInput($request->input())
                ;
        }
        else
        {
            Message::create( $request->all() );
            return redirect( route('conversation', $request->get('receiver_id')) );
        }
    }

    public function messages()
    {
        $auth         = Auth::user();
        $last_message = Message::where('sender_id', $auth->id)->orWhere('receiver_id', $auth->id)->orderByDesc('created_at')->first();
        if($last_message){
            $friend_id  =   $last_message->sender->id == $auth->id? $last_message->receiver->id : $last_message->sender->id;
            return redirect( route('conversation', $friend_id) );
        }
        //else , ie: this user had never sent a message. he will be redirected to a list of users so that he can visit their profiles
        //in their profiles, there's a possibility to contact them by pressing the button 'contact {{user->name}}'
        //code
    }
}