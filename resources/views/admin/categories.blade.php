@extends('layouts.admin-panel')
@section('title', "Категории новостей")

@section('main-content')
    <div class="container lar-main">
        <div class="row justify-content-center">
            @empty($categories)
                <div class="alert alert-warning" role="alert">
                    Категории не созданы
                </div>
            @else
            <div class="row">
                {{ $categories->links() }}
            </div>
            <table class="table table-hover text-start">
                <thead>
                    <tr>
                        <th scope="col" style="width: 80%">Категория</th>
                        <th scope="col">Редактировать</th>
                        <th scope="col">Удалить</th>
                    </tr>
                </thead>
                <tbody>
            @foreach($categories as $category)
                    <tr>
                        <td>
                            <a href="{{ url('/news/cat/' . $category->id) }}" class="text-decoration-none">
                                <div>{{ $category->category }}</div>
                            </a>
                        </td>
                        <td>
                            <a href="{{ '/categories/edit/' . $category->id }}">
                            Редактировать
                            </a>
                        </td>
                        <td>
                            <a
                                class="category-button__delete"
                                href="javascript:;"
                                rel="{{ $category->id }}"
                            >
                            Удалить
                            </a>
                        </td>
                    </tr>
            @endforeach
                </tbody>
            </table>
            <div class="d-grid gap-1">
                <a
                    class="btn btn-outline-secondary"
                    href="{{ url('/categories/create') }}"
                >
                    Добавить новую категорию новостей
                </a>
            </div>
            @endempty
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
            const link = document.querySelectorAll('.category-button__delete');
            link.forEach(function (item) {
                item.addEventListener("click", function () {
                    if (confirm("Вы подтверждаете удаление ?")) {
                        fetchData("{{ url('/categories/delete') }}/" + this.getAttribute('rel'), {
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
        });
    </script>
@endpush

