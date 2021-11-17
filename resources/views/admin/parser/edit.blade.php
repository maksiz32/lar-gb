@extends('layouts.app')
@section('title', 'Редактировать ресурс для парсинга')

@section('content')
<article class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('parse.update') }}" method="POST">
                {{ csrf_field() }}
                @method('PUT')
                <input type="hidden" name="id" value="{{ old('id', $resource->id) }}">
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
                    <label for="path" class="col-md-4 control-label">Адрес ресурса:</label>
                    <input
                        type="text"
                        id="path"
                        class="form-control"
                        name="path"
                        value="{{ old('path', $resource->path)}}"
                        required
                    >
                </div>
                <div class="form-group">
                    <label for="title" class="col-md-4 control-label">Описание:</label>
                    <input
                        type="text"
                        id="title"
                        class="form-control"
                        name="title"
                        value="{{ old('title', $resource->title)}}"
                        required
                    >
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
</article>
@endsection
