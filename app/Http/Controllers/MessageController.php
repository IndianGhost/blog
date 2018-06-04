<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;

class MessageController extends HomeController
{
    public function conversation($id)
    {
        $viewPath = 'messenger.conversation';
        if (is_numeric($id) && $id > 0) {
            $receiver_id = $id;
            $sender_id = Auth::user()->id;
            if ($sender_id != $receiver_id) {
                $receiverMessages = Message::where('receiver_id', $receiver_id)->orWhere('sender_id', $receiver_id)->get();
                $senderMessages = Message::where('receiver_id', $sender_id)->orWhere('sender_id', $sender_id)->get();

                $conversation = $receiverMessages->intersect($senderMessages);

                return view($viewPath, compact('conversation'));
            }
            return redirect(route('my-profile'));
        }
        return view($viewPath);
    }
}