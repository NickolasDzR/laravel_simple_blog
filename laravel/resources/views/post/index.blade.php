@extends('layouts.app')

@section('title', 'Главная страница. Список постов')

@section('content')
    <h1>Список статей</h1>

    @foreach($posts as $post)
        <br>
        <br>
        <br>
        <br>
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->body }}</p>
        <span>Автор: {{ $post->author }}</span>
        <br>

        <a href="{{ route('posts.edit', $post) }}">Редактировать пост {{ $post->id }}</a>
        <br>
        <a href="{{ route('posts.show', $post) }}">Подробнее</a>
        <br>
        <a href="{{ route('posts.destroy', $post) }}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">Удалить Статью {{ $post->title }}</a>
    @endforeach
@endsection