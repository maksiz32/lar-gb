@extends('layouts.app')
@section('title', $feedback->title)

@section('content')
    <div class="container lar-main">
        <div class="row justify-content-center">
            <div class="card m-2" style="width: 38rem;">
                <div class="card-body">
                    <div class="card-text border-bottom pb-4">
                        {{ $feedback->comment }}
                    </div>
                    <div class="card-subtitle pb-4">
                        <small class="text-muted font-monospace">
                            {{ __('дата: ' . $feedback->created_at->format('d M Y H:i')) }}
                        </small>
                            {{"Автор: $feedback->user_name "}}
                    </div>
                    <div class="card-footer">
                        <a
                            class="btn btn-dark"
                            href="{{ url('/feedback/edit/' . $feedback->id) }}"
                        >
                            Редактировать
                        </a>
                        <a
                            class="btn btn-light feedback-button__delete"
                            style="border: 1px solid black"
                            href="#"
                            rel="{{ $feedback->id }}"
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
            const link = document.querySelector('.feedback-button__delete');
            link.addEventListener("click", function () {
                if(confirm("Вы подтверждаете удаление ?")) {
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
    </script>
@endpush
