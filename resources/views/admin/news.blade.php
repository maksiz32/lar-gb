@extends('layouts.admin-panel')
@section('title', "Все новости")

@section('main-content')
    <div class="container lar-main">
        <div class="row justify-content-center">
            @empty($news)
                <div class="alert alert-warning" role="alert">
                    Новостей пока нет
                </div>
            @else
                <h4>Все новости</h4>
            <div class="row">
                {{ $news->links() }}
            </div>
            <table class="table table-hover text-start">
                <thead>
                    <tr>
                        <th scope="col" style="width: 20%">Заголовок</th>
                        <th scope="col" style="width: 40%">Текст</th>
                        <th scope="col">Автор</th>
                        <th scope="col">Категория</th>
                        <th scope="col">Имя ресурса</th>
                        <th scope="col">Адрес ресурса</th>
                        <th scope="col">Дата</th>
                        <th scope="col">Редактировать</th>
                        <th scope="col">Удалить</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($news as $new)
                    <tr>
                        <td>{{ $new->title }}</td>
                        <td>{{ $new->text }}</td>
                        <td>{{ $new->author }}</td>
                        <td>{{ $new->category->category }}</td>
                        <td>{{ $new->source->name }}</td>
                        <td>{{ $new->source->path }}</td>
                        <td>{{ __($new->created_at->format('d.m.Y H:i')) }}</td>
                        <td>
                            <a href="{{ '/news/edit/' . $new->id }}">
                            Редактировать
                            </a>
                        </td>
                        <td>
                            <a
                                class="news-button__delete text-danger"
                                href="#"
                                rel="{{ $new->id }}"
                            >
                            Удалить
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endempty
            <div class="d-grid gap-1 mb-5">
                <a
                    class="btn btn-outline-secondary"
                    href="{{ url('/news/create') }}"
                >
                    Добавить новость
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
            const link = document.querySelectorAll('.news-button__delete');
            link.forEach(function (item) {
                item.addEventListener("click", function () {
                    if (confirm("Вы подтверждаете удаление ?")) {
                        fetchData("{{ url('/news/delete') }}/" + this.getAttribute('rel'), {
                            method: "DELETE",
                            headers: {
                                'Content-Type': 'application/json; charset=utf-8',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        }).then((Response) => {
                            alert(Response.message);
                            window.location.href = '/admin/news';
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
