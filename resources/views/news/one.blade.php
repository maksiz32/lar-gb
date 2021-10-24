@extends('layouts.app')
@section('title', $news->title)

@section('content')
    <div class="container lar-main">
        <div class="row justify-content-center">
            <div class="card m-2" style="width: 38rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $news->title }}
                        <p class="text-end border-top">
                            <small class="text-muted font-monospace">
                                {{ __('дата: ' . $news->created_at->format('d M Y H:i')) }}
                            </small>
                        </p>
                    </h5>
                    <p class="card-text">
                        {{ $news->text }}
                    </p>
                    <hr/>
                    <div class="card-subtitle">
                        {{"Автор: $news->author "}}
                        @isset($news->source){{"Ресурс: {$news->source->name} ({$news->source->path}) "}}@endisset
                        @isset($news->category){{"Категория: {$news->category->category}"}}@endisset
                    </div>
                    <div class="card-footer">
                        <a
                            class="btn btn-dark"
                            href="{{ url('/news/edit/' . $news->id) }}"
                        >
                            Редактировать
                        </a>
                        <a
                            class="btn btn-light"
                            style="border: 1px solid black"
                            href="{{ url('/news/delete/' . $news->id) }}">
                            Удалить
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
