@extends('layouts.app')
@section('title', 'Редактировать отзыв')

@section('content')
    <article class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('feedback.update') }}" method="POST">
                    {{ csrf_field() }}
                        @method('PUT')
                        <input type="hidden" value="{{ old('id', $feedback->id) }}" name="id">
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
                        <label for="user_name" class="col-md-4 control-label">Имя пользователя:</label>
                        <input
                            type="text"
                            id="user_name"
                            class="form-control"
                            name="user_name"
                            value="{{ old('user_name', $feedback->user_name) }}"
                            required
                        >
                        </div>
                        <div class="form-group mb-2">
                            <label for="comment" class="col-md-4 control-label">Комментарий:</label>
                            <input
                                type="text"
                                id="comment"
                                class="form-control"
                                name="comment"
                                required
                                value="{{ old('comment', $feedback->comment) }}"
                            >
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Сохранить
                        </button>
                        <button type="reset" class="btn btn-outline-primary">
                            Отмена
                        </button>
                </form>
            </div>
        </div>
    </article>
@endsection
