@extends('layouts.app')
@section('title', 'Добавить новость')

@section('content')
<article class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('news.input') }}" method="POST">
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
                <div class="form-group">
                    <label for="categories" class="col-md-4 control-label">Тип объекта:</label>
                    <select name="categories" required>
                        <option disabled>Тип объекта:</option>
                        @foreach($categories as $cat)
                            <option
                                value="{{ $cat->id }}"
                                @isset($news)
                                {{ $news->category_id === $cat->id ? 'selected' : ''}}
                                @endisset
                            >{{ $cat->category }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title" class="col-md-4 control-label">Заголовок:</label>
                    <input
                        type="text"
                        id="title"
                        class="form-control"
                        name="title"
                        value="@isset($news->title){{$news->title}}@endisset
                        {{old('title')}}"
                        required
                    >
                </div>
                <div class="form-group">
                    <label for="textNews" class="col-md-4 control-label">Текст:</label>
                    <textarea
                        type="text"
                        id="textNews"
                        class="form-control"
                        name="textNews"
                        required
                    >@isset($news->text){{$news->text}}@endisset
                        {{old('textNews')}}
                    </textarea>
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
