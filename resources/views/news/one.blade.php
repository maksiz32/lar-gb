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
                        {!! $news->text !!}
                    </p>
                    <hr/>
                    <div class="card-subtitle">
                        {{"Автор: $news->author "}}
                        @isset($news->resource){{"Ресурс: {$news->resource->title} ({$news->resource->path}) "}}@endisset
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
                            class="btn btn-light news-button__delete"
                            style="border: 1px solid black"
                            href="#"
                            rel="{{ $news->id }}"
                                >
                            Удалить
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type='text/javascript'>
        document.addEventListener('DOMContentLoaded', function() {
            const fetchData = async (url, options) => {
                const response = await fetch(`${url}`, options);
                const body = await response.json();
                return body;
            }
            const link = document.querySelector('.news-button__delete');
            link.addEventListener("click", function () {
                if(confirm("Вы подтверждаете удаление ?")) {
                    fetchData("{{ url('/news/delete') }}/" + this.getAttribute('rel'), {
                        method: "DELETE",
                        headers: {
                            'Content-Type': 'application/json; charset=utf-8',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then((Response) => {
                        alert(Response.message);
                        window.location.href = '/categories';
                    })
                    .catch(() => {
                        alert(Response.message);
                        return false;
                    })
                }
            });
        });
    </script>
@endpush
