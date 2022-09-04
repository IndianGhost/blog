<?php

namespace App\Services;

use App\Post;
use Illuminate\Validation\Validator;

interface PostService {

    public function validator($data): Validator;

    public function create($data): Post;

    public function update($id, $data): Post;

    public function delete($id): Post;
}
