@extends('layouts.admin-panel')
@section('title', "Все ресурсы")

@section('main-content')
    <div class="container lar-main">
        <div class="row justify-content-center">
            @if(count($resources) < 1)
                <div class="alert alert-warning" role="alert">
                    Записей пока нет
                </div>
            @else
                <h4>Ресурсы для парсинга</h4>
            <div class="row">
                {{ $resources->links() }}
            </div>
            <table class="table table-hover text-start">
                <thead>
                    <tr>
                        <th scope="col" style="width: 5%">ID</th>
                        <th scope="col" style="width: 60%">Адрес</th>
                        <th scope="col">Описание</th>
                        <th scope="col">Редактировать</th>
                        <th scope="col">Удалить</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($resources as $resource)
                    <tr>
                        <td>{{ $resource->id }}</td>
                        <td>{{ $resource->path }}</td>
                        <td>{{ $resource->title }}</td>
                        <td>
                            <a href="{{ route('parse.edit', ['resource' => $resource->id]) }}">
                            Редактировать
                            </a>
                        </td>
                        <td>
                            <a
                                class="resource-button__delete text-danger"
                                href="#"
                                rel="{{ $resource->id }}"
                            >
                            Удалить
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endif
            <div class="d-grid gap-1 mb-5">
                <a
                    class="btn btn-outline-secondary"
                    href="{{ route('parse.create') }}"
                >
                    Добавить ресурсы
                </a>
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
            const link = document.querySelectorAll('.resource-button__delete');
            link.forEach(function (item) {
                item.addEventListener("click", function () {
                    if (confirm("Вы подтверждаете удаление ?")) {
                        fetchData("{{ url('/resource/delete') }}/" + this.getAttribute('rel'), {
                            method: "DELETE",
                            headers: {
                                'Content-Type': 'application/json; charset=utf-8',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        }).then((Response) => {
                            alert(Response.message);
                            window.location.href = '/parse';
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
