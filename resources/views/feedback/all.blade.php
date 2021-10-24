@extends('layouts.app')
@section('title', "Все отзывы")

@section('content')
    @isset($message)
        <div class="alert alert-success mt-3 mb-3">
            {!! $message !!}
        </div>
    @endisset
    @empty($feedbacks)
        <div class="alert alert-warning" role="alert">
            Отзывов пока нет
        </div>
    @endempty
    <div class="container lar-main">
        <div class="row justify-content-center">
            @foreach($feedbacks as $one)
                <a href="{{ url('/feedback/show/' . $one->id) }}" class="text-decoration-none">
                    <div class="card m-2 hovered">
                        <div class="card-body">
                            <h5 class="card-title">{{ $one->user_name }}</h5>
                            <p class="card-text">
                                {{ $one->comment }}
                            </p>
                            <div class="card-subtitle">
                                {{ __('дата: ' . $one->created_at->format('d M Y H:i')) }}
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
            {{ $feedbacks->links() }}
        </div>
    </div>
@endsection
