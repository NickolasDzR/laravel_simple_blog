<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index() {
        $posts = Post::with('user')->orderBy('id', 'desc')->get();

        return view('post.index', compact('posts'));
    }

    public function show(Post $post) {
        return view('post.show', compact('post'));
    }

    public function create() {
        $post = new Post();

        return view('post.create', compact('post'));
    }

    public function store(Request $request, Post $post) {

        $data = $request->validate([
            'title' => 'required|string|min:10',
            'body' => 'required|string|min:10',
        ]);

        $post->create([
            ...$data,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('posts.index')->with('status', 'Пост успешно создан!');
    }

    public function edit(Post $post) {
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, Post $post) {
        if (!Gate::allows('update-post', $post)) {
            abort(403);
        }

        $data = $request->validate([
            'title' => [
                'required',
                'min:10',
                Rule::unique('posts')->ignore($post->id),
            ],
            'body' => 'required|string|min:100',
        ]);

        $post->update($data);

        return redirect()->route('posts.index')->with('status', 'Пост успешно обнавлён');
    }

    public function destroy(Post $post) {
        $post->delete();
        return redirect()->route('posts.index')->with('status', 'Пост успешно удален!');
    }
}
