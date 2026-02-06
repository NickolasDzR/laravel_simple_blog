@extends('layouts.app')

@section('title', 'Создание поста')

@section('content')
    <h1>Создать новый пост</h1>
    <br>
    <br>

{{ html()->modelForm($post, 'POST', route('posts.store'))->open() }}

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