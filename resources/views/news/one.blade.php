@extends('layouts.app')
@section('title', $news[0]['title'])

@section('content')
    <div class="container lar-main">
        <div class="row justify-content-center">
            <div class="card m-2" style="width: 38rem;">
                <div class="card-body hovered">
                    <h5 class="card-title">{{ $news[0]['title'] }}</h5>
                    <p class="card-text">
                        {{ $news[0]['text'] }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
