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

    Лайков: {{ $post->likes->count() }}

    <br><br>

    <br>
    <br>
    <a href="{{ route('posts.index') }}">Назад</a>
@endsection