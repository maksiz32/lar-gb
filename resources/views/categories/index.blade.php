@extends('layouts.app')
@section('title', "Категории новостей")

@section('content')
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
            @foreach($categories as $cat)
                    <tr>
                        <td>
                            <a href="{{ url('/news/cat/' . $cat->id) }}" class="text-decoration-none">
                                <div>{{ $cat->category }}</div>
                            </a>
                        </td>
                        <td>
                            <a href="{{ '/categories/edit/' . $cat->id }}">
                            Редактировать
                            </a>
                        </td>
                        <td>
                            <a href="{{ '/categories/delete/' . $cat->id }}">
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

