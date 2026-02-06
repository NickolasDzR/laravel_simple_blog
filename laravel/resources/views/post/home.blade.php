@extends('layouts.app')

@section('title', 'Список постов пользователя ' . $user->name)

@section('content')
        <h1>Список статей пользователя {{ $user->name}} 123</h1>
    @foreach($posts as $post)
        <br>
        <br>
        <br>
        <br>
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->body }}</p>
        <br>
        <br>
        @can("update-post", $post)
            <a href="{{ route('posts.edit', $post) }}">Редактировать пост</a>
            <br>
            <br>
        @endcan
        @can("delete-post", $post)
            <a href="{{ route('posts.destroy', $post) }}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">Удалить cтатью</a>
        @endcan
        <br>
        <br>
        <a href="{{ route('posts.index') }}">Назад</a>
    @endforeach
@endsection