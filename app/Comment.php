<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'user_id', 'post_id',
    ];

    public static $rules = [
        'user_id'   =>  'required|numeric|min:1',
        'post_id'   =>  'required|numeric|min:1',
        'content'   =>  'required'
    ];

    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeSearchByUser($query, $id)
    {
        return $query->where('user_id', $id);
    }
}
