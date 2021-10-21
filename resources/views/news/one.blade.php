@extends('layouts.app')
@section('title', $news->title)

@section('content')
    <div class="container lar-main">
        <div class="row justify-content-center">
            <div class="card m-2" style="width: 38rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $news->title }}</h5>
                    <p class="card-text">
                        {{ $news->text }}
                    </p>
                    <div class="card-footer">
                        <a
                            class="btn btn-dark"
                            href="{{ url('/news/edit/' . $news->id) }}"
                        >
                            Редактировать
                        </a>
                        <a class="btn btn-light" style="border: 1px solid black" href="#">
                            Удалить
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
