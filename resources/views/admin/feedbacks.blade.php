@extends('layouts.admin-panel')
@section('title', "Все отзывы")

@section('main-content')
    @if(session()->get('message'))
        <div class="alert alert-success mt-3 mb-3">
            {!! session()->get('message') !!}
        </div>
    @endif
    @empty($feedbacks)
        <div class="alert alert-warning" role="alert">
            Отзывов пока нет
        </div>
    @else
        <div class="row justify-content-center">
            <table class="table table-hover text-start">
                <thead>
                <tr>
                    <th scope="col" style="width: 25%">Имя</th>
                    <th scope="col" style="width: 55%">Отзыв</th>
                    <th scope="col">Редактировать</th>
                    <th scope="col">Удалить</th>
                </tr>
                </thead>
                <tbody>
            @foreach($feedbacks as $feedback)
                <tr>
                    <td>{{ $feedback->user_name }}</td>
                    <td>{{ $feedback->comment }}</td>
                    <td>
                        <a
                            href="{{ url('/feedback/edit/' . $feedback->id) }}"
                        >
                            Редактировать
                        </a>
                    </td>
                    <td>
                        <a
                            class="feedback-button__delete"
                            href="#"
                            rel="{{ $feedback->id }}"
                        >
                            Удалить
                        </a>
                    </td>
                </tr>
            @endforeach
            {{ $feedbacks->links() }}
        </div>
    @endempty
@endsection
@push('js')
    <script type='text/javascript'>
        document.addEventListener('DOMContentLoaded', function() {
            const fetchData = async (url, options) => {
                const response = await fetch(`${url}`, options);
                const body = await response.json();
                return body;
            }
            const link = document.querySelector('.feedback-button__delete');
            link.forEach(function (item) {
                item.addEventListener("click", function () {
                    if (confirm("Вы подтверждаете удаление ?")) {
                        fetchData("{{ url('/feedback/delete') }}/" + this.getAttribute('rel'), {
                            method: "DELETE",
                            headers: {
                                'Content-Type': 'application/json; charset=utf-8',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        }).then((Response) => {
                            alert(Response.message);
                            window.location.href = '/feedback';
                        })
                            .catch(() => {
                                alert(Response.message);
                                return false;
                            })
                    }
                });
            });
        });
    </script>
@endpush
