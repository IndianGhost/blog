<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User as Receiver;
use App\User as Sender;

class Message extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'sender_id', 'receiver_id',
    ];

    public static $rules = [
        'receiver_id'   =>  'required|numeric|min:1',
        'sender_id'     =>  'required|numeric|min:1',
        'content'       =>  'required'
    ];

    public function sender()
    {
        return $this->belongsTo('App\Sender');
    }

    public function receiver()
    {
        return $this->belongsTo('App\Receiver');
    }
}
