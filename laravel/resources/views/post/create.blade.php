@extends('layouts.app')

@section('title', 'Создание поста')

@section('content')
{{ html()->modelForm($post, 'POST', route('posts.store'))->open() }}

    {{ html()->label('Имя автора', 'author')->class('form-label') }}
    {{ html()->input('text', 'author')->class('form-control') }}
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
    {{ html()->submit('Создать')->class('btn btn-primary') }}

{{ html()->closeModelForm() }}
@endsection