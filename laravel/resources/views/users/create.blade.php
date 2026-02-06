@extends('layouts.app')

@section('title', 'Регистрация пользователя')

@section('content')
    <h1 class="text-center">Регистрация пользователя</h1>


        {{ html()->form('POST', route('register.store'))->open() }}

        {{ html()->label('Ваше имя', 'name')->class('form-label') }}
        {{ html()->input('text', 'name')->class('form-control') }}
        <br>
        <br>
        {{ html()->label('Ваша электронная почта', 'email')->class('form-label') }}
        {{ html()->input('text', 'email')->class('form-control') }}
        <br>
        <br>
        {{ html()->label('Пароль', 'password')->class('form-label') }}
        {{ html()->input('text', 'password')->class('form-control') }}
        <br>
        <br>
        {{ html()->submit('Зарегистрировать')->class('btn btn-primary') }}

        {{ html()->form()->close() }}
@endsection