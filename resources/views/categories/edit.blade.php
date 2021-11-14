@extends('layouts.app')
@section('title', 'Редактировать категорию новостей')

@section('content')
    <article class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ action([\App\Http\Controllers\CategoryController::class, 'store']) }}" method="POST">
                    {{ csrf_field() }}
                    @isset($category->id)
                        @method('PUT')
                        <input type="hidden" value="{{ $category->id }}" name="id">
                    @endisset
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
                            value="@isset($category->category){{ $category->category }}@endisset{{old('category')}}"
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
