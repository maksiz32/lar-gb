@extends('layouts.app')
@section('title', "Главная страница")

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @isset($message)
                <div class="alert alert-success mt-3 mb-3">
                    {{ $message }}
                </div>
            @endisset
            <h1>Laravel. Глубокое погружение</h1>
        </div>
        <div class="justify-content-end align-bottom lar-main__name">
            <p class="text-dark">Максим Манзулин</p>
        </div>
    </div>
@endsection
