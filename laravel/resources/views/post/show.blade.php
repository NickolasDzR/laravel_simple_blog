@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <h1>Список статей</h1>
    <br>
    <h2>{{ $post->title }}</h2>
    <p>{{ $post->body }}</p>
    @if($post->user)
        <span>Автор: {{ $post->user->name }}</span>
    @else
        <span>Автор: Удалён :(</span>
    @endif
    <br>
    <br>
    @if($post->user)
        @can("update-post", $post)
            <a href="{{ route('posts.edit', $post) }}">Редактировать пост</a>
            <br>
            <br>
        @endcan
    @endif
    @can("delete-post", $post)
        <a href="{{ route('posts.destroy', $post) }}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">Удалить cтатью</a>
    @endcan

    @if($post->isLikedBy(auth()->user()))
        <form action="{{ route('posts.unlike', $post) }}" method="POST">
            @csrf @method('DELETE')
            <button type="submit">❤️ Убрать лайк</button>
        </form>
    @else
        <form action="{{ route('posts.like', $post) }}" method="POST">
            @csrf
            <button type="submit">🤍 Лайк</button>
        </form>
    @endif

    <div class="likes_count" x-data="likes_count_popup" @mouseover="toggle">
        Лайков: {{ $post->likes_count }}
    </div>

    <div class="likes_count_popup">
        @if($post->likes->isEmpty())
            <p>Пока твоя статья еще никому не понравилась 😢</p>
        @else
            <span>Кто лайкнул?</span>
            <ul>
                @foreach ($post->likes as $like)
                    <li style="margin-top: 10px;">
                        <p style="margin: 0; padding: 0;">Ник: {{ $like->user->name }}</p>
                        <span style="margin: 0; padding: 0;">Когда: {{ $like->created_at->format('d.m.Y H:i') }}</span>
                    </li>
                @endforeach
            </ul>
        @endif

    </div>

    <br><br>

    <br>
    <br>
    <a href="{{ route('posts.index') }}">Назад</a>
@endsection