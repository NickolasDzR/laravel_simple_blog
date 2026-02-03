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
        <span>Автор: {{ $post->user->name }}</span>
        <br>

        @can('update-post', $post)
            <a href="{{ route('posts.edit', $post) }}">Редактировать пост {{ $post->id }}</a>
            <br>
        @endcan
        <a href="{{ route('posts.show', $post) }}">Подробнее</a>
        @can('delete-post', $post)
            <br>
            <form action="{{ route('posts.destroy', $post) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Удалить</button>
            </form>
        @endcan
    @endforeach
@endsection