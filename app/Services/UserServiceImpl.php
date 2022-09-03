<?php

namespace App\Services;

use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidationValidator;

class UserServiceImpl implements UserService {

    private User $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function validator($data): ValidationValidator {
        Log::info("UserServiceImpl: validator(\$data)");
        return Validator::make($data, User::$rules);
    }

    public function create($data): User {
        Log::info("UserServiceImpl: create(\$data)");
        foreach ($this->user->getFillable() as $fillable) {
            if ($fillable === "password") {
                $this->user->setAttribute($fillable, bcrypt($data[$fillable]));
                continue;
            }
            $this->user->setAttribute($fillable, $data[$fillable]);
        }
        $this->user->save();
        $this->user->fresh();
        return $this->user;
    }

}
