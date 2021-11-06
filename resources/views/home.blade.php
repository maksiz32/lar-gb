@extends('layouts.app')
@section('title', "Страница авторизации")

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Форма') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Вход успешно выполнен') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
