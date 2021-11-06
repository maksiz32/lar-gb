@extends('layouts.app')
@section('title', 'Редактирование пользователя')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('admin.user') }}" method="POST">
                {{ csrf_field() }}
                @method('PUT')
                <input type="hidden" name="id" value="{{$user->id}}{{old('id')}}">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <label class="col-md-4 control-label">Имя:</label>
                    <input
                        type="text"
                        class="form-control"
                        value="{{$user->name}}"
                        readonly
                    >
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Email:</label>
                    <input
                        type="text"
                        class="form-control"
                        value="{{$user->email}}"
                        readonly
                    >
                </div>
                <div class="form-group">
                    <label for="role_id" class="col-md-4 control-label">Тип объекта:</label>
                    <select class="form-control" name="role_id" required>
                        <option disabled>Роль:</option>
                        @foreach($roles as $role)
                            <option
                                value="{{ $role->id }}"
                                {{ $user->role_id === $role->id ? 'selected' : ''}}
                            >{{ $role->role }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="btn-group mt-2">
                    <button type="submit" class="btn btn-primary">
                        Сохранить
                    </button>
                    <button type="reset" class="btn btn-outline-primary">
                        Отмена
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
