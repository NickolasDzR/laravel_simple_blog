<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index() {
        $posts = Post::with('user')->orderBy('id', 'desc')->get();

        return view('post.index', compact('posts'));
    }

    public function likes_post() {
        $posts = auth()->user()->likes->map(fn($like) => $like->post);

        return view('post.index', compact('posts'));
    }

    public function home() {
        if (!Auth::check()) {
            return redirect()->route('login'); // перенаправляем на логин
        }

        $user = Auth::user();

        $posts = $user->posts()->latest()->get();
        return view('post.home', compact('posts', 'user'));
    }

    public function show(Post $post) {
        $post->load('likes.user');
        $post->loadCount('likes');

        return view('post.show', compact('post'));
    }

    public function create(User $user) {
        if (Gate::denies('create-post')) {
            abort(403);
        }

        $post = new Post();

        return view('post.create', compact('post'));
    }

    public function store(Request $request, Post $post) {
        if (Gate::denies('create-post')) {
            abort(403);
        }

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
        if (Gate::denies('update-post', $post)) {
            abort(403);
        }

        return view('post.edit', compact('post'));
    }

    public function update(Request $request, Post $post) {

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
        if (Gate::denies('delete-post', $post)) {
            abort(403);
        }

        $post->delete();
        return redirect()->route('posts.index')->with('status', 'Пост успешно удален!');
    }
}
