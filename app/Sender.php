<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User as Member;

class Sender extends Member
{
    public function message()
    {
        return $this->hasMany('App\Message');
    }
}
