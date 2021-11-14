@extends('layouts.app')
@section('title', 'Добавить категорию новостей')

@section('content')
    <article class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('categories.input') }}" method="POST">
                    {{ csrf_field() }}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-group mb-3">
                        <label for="category" class="col-md-4 control-label">Название категории:</label>
                        <input
                            type="text"
                            class="form-control"
                            name="category"
                            value="{{old('category')}}"
                            required
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
