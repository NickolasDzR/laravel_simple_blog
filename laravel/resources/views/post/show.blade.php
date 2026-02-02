@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <h1>Список статей</h1>
    <br>
    <h2>{{ $post->title }}</h2>
    <p>{{ $post->body }}</p>
    <span>Автор: {{ $post->user->name }}</span>
    <br>
    <br>
    @can("update-post", $post)
        <a href="{{ route('posts.edit', $post) }}">Редактировать пост</a>
        <br>
        <br>
        <a href="{{ route('posts.destroy', $post) }}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">Удалить cтатью</a>
    @endcan
    <br>
    <br>
    <a href="{{ route('posts.index') }}">Назад</a>
@endsection