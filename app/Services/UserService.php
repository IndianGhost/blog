<?php

namespace App\Services;

use App\User;
use Illuminate\Validation\Validator;

interface UserService {

    public function validator($data): Validator;

    public function create($data): User;
}
