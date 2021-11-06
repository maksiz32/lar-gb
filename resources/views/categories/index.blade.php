@extends('layouts.app')
@section('title', "Категории новостей")

@section('content')
    <div class="container lar-main">
        <div class="row justify-content-center">
            <div class="row">
                {{ $categories->links() }}
            </div>
            @foreach($categories as $category)
                <a href="{{ url('/news/cat/' . $category->id) }}" class="text-decoration-none">
                    <div class="card m-2 hovered">
                        <div class="card-body">
                            <div>{{ $category->category }}</div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
