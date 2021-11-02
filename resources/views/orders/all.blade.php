@extends('layouts.app')
@section('title', "Все заказы")

@section('content')
    <div class="container lar-main">
        <div class="row justify-content-center">
            @empty($orders)
                <div class="alert alert-warning" role="alert">
                    Заказов пока нет
                </div>
            @else
            <div class="row">
                {{ $orders->links() }}
            </div>
            <table class="table table-hover text-start">
                <thead>
                    <tr>
                        <th scope="col" style="width: 25%">Инфо</th>
                        <th scope="col" style="width: 55%">Заказ</th>
                        <th scope="col">Редактировать</th>
                        <th scope="col">Удалить</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>
                            <div>{{ $order->name }}</div>
                            <div>{{ $order->phone }}</div>
                            <div>{{ $order->email }}</div>
                            <div>{{ __('дата: ' . $order->created_at->format('d M Y H:i')) }}</div>
                        </td>
                        <td>
                            <div>{{ $order->order }}</div>
                        </td>
                        <td>
                            <a href="{{ '/order/edit/' . $order->id }}">
                            Редактировать
                            </a>
                        </td>
                        <td>
                            <a href="{{ '/order/delete/' . $order->id }}">
                            Удалить
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endempty
            <div class="d-grid gap-1">
                <a
                    class="btn btn-outline-secondary"
                    href="{{ url('/order/input') }}"
                >
                    Добавить новый заказ
                </a>
            </div>
        </div>
    </div>
@endsection

