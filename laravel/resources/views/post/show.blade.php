@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <h1>Список статей</h1>
    <br>
    <h2>{{ $post->title }}</h2>
    <p>{{ $post->body }}</p>
    <span>Автор: {{ $post->author }}</span>
    <a href="{{ route('posts.edit', $post) }}">Редактировать пост {{ $post->id }}</a>
    <br>
    <a href="{{ route('posts.index') }}">Назад</a>
    <br>
    <a href="{{ route('posts.destroy', $post) }}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">Удалить Статью {{ $post->name }}</a>
@endsection