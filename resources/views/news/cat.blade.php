@extends('layouts.app')
@section('title', "Новости из категории $catName")

@section('content')
    @if(session()->get('message'))
        <div class="alert alert-success mt-3 mb-3">
            {!! session()->get('message') !!}
        </div>
    @endif
    @empty($news)
        <div class="alert alert-warning" role="alert">
            Нет записей в данной категории
        </div>
    @else
    <div class="container lar-main">
        <div class="row justify-content-center">
            <h2>{{ __("Новости в категории $catName") }}</h2>
            @foreach($news as $one)
                <a href="{{ url('/news/one/' . $one->id) }}" class="text-decoration-none">
                    <div class="card m-2 hovered">
                        <div class="card-body">
                            <h5 class="card-title">{{ $one->title }}</h5>
                            <p class="card-text">
                                {{ $one->text }}
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach
            {{ $news->links() }}
        </div>
    </div>
    @endempty
@endsection
