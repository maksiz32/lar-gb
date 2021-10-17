@extends('layouts.app')
@section('title', "Новости из категории $catName")

@section('content')
    @empty($news)
        <div class="alert alert-warning" role="alert">
            Нет записей в данной категории
        </div>
    @endempty
    <div class="container lar-main">
        <div class="row justify-content-center">
            @foreach($news as $one)
                <a href="{{ url('/news/one/' . $one['id']) }}" class="text-decoration-none">
                    <div class="card m-2 hovered">
                        <div class="card-body">
                            <h5 class="card-title">{{ $one['title'] }}</h5>
                            <p class="card-text">
                                {{ $one['text'] }}
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
