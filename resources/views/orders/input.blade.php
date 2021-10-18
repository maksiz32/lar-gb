@extends('layouts.app')
@section('title', 'Добавить заказ')

@section('content')
    <article class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('order.save') }}" method="POST">
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
                    <h2>Оформить заказ</h2>
                    <div class="form-group">
                        <label for="name" class="col-md-4 control-label">Имя:</label>
                        <input
                            type="text"
                            id="name"
                            class="form-control"
                            name="name"
                            value="{{old('name')}}"
                            required
                        >
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-md-4 control-label">Телефон:</label>
                        <input
                            type="phone"
                            id="phone"
                            class="form-control"
                            name="phone"
                            value="{{old('phone')}}"
                            required
                        >
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">E-mail:</label>
                        <input
                            type="email"
                            id="email"
                            class="form-control"
                            name="email"
                            value="{{old('email')}}"
                            required
                        >
                    </div>
                    <div class="form-group mb-2">
                        <label for="order" class="col-md-4 control-label">Заказ:</label>
                        <textarea
                            type="text"
                            id="order"
                            class="form-control"
                            name="order"
                            required
                        >
                            {{old('order')}}
                        </textarea>
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
