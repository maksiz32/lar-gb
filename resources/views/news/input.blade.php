@extends('layouts.app')
@section('title', 'Добавить новость')

@section('content')
<article class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('news.input') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="categories" class="col-md-4 control-label">Тип объекта:</label>
                    <select name="categories">
                        <option disabled>Тип объекта:</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}">{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="title" class="col-md-4 control-label">Заголовок:</label>
                    <input type="text" id="title" class="form-control" name="title" value="{{old('title')}}">

                </div>
                <div class="form-group">
                    <label for="textNews" class="col-md-4 control-label">Дата создания:</label>
                    <input type="text" id="textNews" class="form-control" name="textNews" value="{{old('textNews')}}">
                </div>
                <div class="btn-group mt-2">
                    <button type="submit" class="btn btn-primary">
                        Сохранить
                    </button>
                    <button type="reset" class="btn btn-info">
                        Отмена
                    </button>
                </div>
            </form>
        </div>
    </div>
</article>
@endsection
