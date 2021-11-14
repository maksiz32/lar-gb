@extends('layouts.admin-panel')
@section('title', 'Пользователи')

@section('main-content')
    <div class="container">

        <table class="table table-hover text-start">
            <thead>
            <tr>
                <th scope="col-2">Имя</th>
                <th scope="col">E-Mail</th>
                <th scope="col">Роль</th>
                <th scope="col">Редактировать</th>
                <th scope="col">Удалить</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td>
                        {{ $user->role->role }}
                    </td>
                    <td>
                        <a href="{{ url('/admin/user/' . $user->id) }}">
                            Редактировать
                        </a>
                    </td>
                    <td>
                        <a
                            class="category-button__delete text-danger"
                            href="javascript:;"
                            rel="{{ $user->id }}"
                        >
                            Удалить
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
