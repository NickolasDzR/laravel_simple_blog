<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Post $post) {
        $like = $post->likes()->make();

        $like->user()->associate(auth()->user());

        $like->save();

        return back();
    }

    public function destroy(Post $post) {
        $post->likes()->where('user_id', auth()->id())->delete();
        return back();
    }
}
