@extends('layouts.app')
@section('title', "Категории новостей")

@section('content')
    <div class="container lar-main">
        <div class="row justify-content-center">
            @foreach($categories as $cat)
            <a href="{{ url('/news/cat/' . $cat) }}" class="text-decoration-none">
                <div class="card hovered">
                    <div class="card-body">
                        {{ $cat }}
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
@endsection

