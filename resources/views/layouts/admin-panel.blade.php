@extends('layouts.app')
@section('title', 'Админка')

@section('content')
    <div class="container-fluid">
        <div id="admin-panel" style="display: flex">
            <div class="admin-panel-left-nav" style="max-width: 20%">
                <nav class="nav flex-column">
                    <a class="nav-link" href="{{ route('admin.news') }}">Новости</a>
                    <a class="nav-link" href="{{ route('admin.categories') }}">Категории новостей</a>
                    <a class="nav-link" href="{{ route('admin.feedbacks') }}">Отзывы</a>
                    <a class="nav-link" href="{{ route('admin.orders') }}">Заказы</a>
                    <a class="nav-link" href="{{ route('admin.users') }}">Пользователи</a>
                </nav>
            </div>
            <div class="admin-panel-main" style="min-width: 60%; margin: 0 auto">
                @yield('main-content')
            </div>
        </div>
    </div>
@endsection
