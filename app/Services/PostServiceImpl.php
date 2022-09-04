<?php

namespace App\Services;

use App\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidationValidator;

class PostServiceImpl implements PostService {

    private Post $post;

    public function __construct(Post $post) {
        $this->post = $post;
    }

    public function validator($data): ValidationValidator {
        return Validator::make($data, Post::$rules);
    }

    public function create($data): Post {
        $this->assignDataToFillableAttributes($data);
        $this->post->save();
        $this->post->fresh();
        return $this->post;
    }

    public function update($id, $data): Post {
        DB::beginTransaction();
        $this->post = Post::find($id);
        $this->assignDataToFillableAttributes($data);
        $this->post->update();
        DB::commit();
        return $this->post;
    }

    public function delete($id): Post {
        DB::beginTransaction();
        try {
            $this->post = Post::find($id);
            $this->post->delete();
        } catch (Exception $ex) {
            DB::rollBack();
            Log::info($ex->getMessage());
            throw new InvalidArgumentException("Unable to delete post data");
        }
        DB::commit();
        return $this->post;
    }

    private function assignDataToFillableAttributes($data): void {
        foreach ($this->post->getFillable() as $fillable) {
            $this->post->setAttribute($fillable, $data[$fillable]);
        }
    }

}
