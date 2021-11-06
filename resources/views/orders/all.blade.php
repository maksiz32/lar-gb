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
                <h2>Все заказы</h2>
                <div class="row">
                    {{ $orders->links() }}
                </div>
                @foreach($orders as $order)
                    <div class="card m-2 hovered">
                        <div class="card-body">
                            <h5 class="card-title">{{ $order->name }}</h5>
                            <p class="card-text">{{ $order->order }}</p>
                            <div class="card-footer small text-end">
                                ({{ $order->phone }}
                                {{ $order->email }}
                                {{ __('дата: ' . $order->created_at->format('d M Y H:i')) }})
                            </div>
                        </div>
                    </div>
                @endforeach
            @endempty
            <div class="d-grid gap-1 mb-5">
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
