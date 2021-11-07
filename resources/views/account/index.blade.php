@extends('layouts.app')
@section('title', 'Личный кабинет пользователя')

@section('content')
    <div class="container">
        @if(Auth::user()->avatar)
            <img src="{{ Auth::user()->avatar }}" style="max-width: 100px;">
            <br />
        @endif
        <h2>Добро пожаловать {{ Auth::user()->name }}</h2>
        <br />
        @if(Auth::user()->role_id === 1)
        <a href="{{ route('admin.index') }}">Перейти в админку</a>
        @endif
    </div>
@endsection
