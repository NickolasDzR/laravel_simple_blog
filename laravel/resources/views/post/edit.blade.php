@extends('layouts.app')

@section('title', 'Редактирование поста '.$post->id)

@section('content')
    {{ html()->modelForm($post, 'PATCH', route('posts.update', $post))->open() }}

    {{ html()->label('Имя автора. Задаётся только при создании', 'author')->class('form-label') }}
    {{ html()->input('text', 'author')->class('form-control')->disabled() }}
    <br>
    <br>

    {{ html()->label('Название статьи', 'title')->class('form-label') }}
    {{ html()->input('text', 'title')->class('form-control') }}
    <br>
    <br>
    {{ html()->label('Статья', 'body')->class('form-label') }}
    {{ html()->textarea('body')->class('form-control') }}
    <br>
    <br>
    {{ html()->submit('Редактировать')->class('btn btn-primary') }}

    {{ html()->closeModelForm() }}
@endsection