@extends('layouts.app')
@section('title', 'Редактировать категорию новостей')

@section('content')
    <article class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('categories.update') }}" method="POST">
                    {{ csrf_field() }}
                    @method('PUT')
                    <input type="hidden" value="{{ old('id', $category->id) }}" name="id">

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
                            value="{{old('category', $category->category)}}"
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
