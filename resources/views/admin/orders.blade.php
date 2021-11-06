@extends('layouts.admin-panel')
@section('title', "Все заказы")

@section('main-content')
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
                            {{ $order->order }}
                        </td>
                        <td>
                            <a href="{{ '/order/edit/' . $order->id }}">
                            Редактировать
                            </a>
                        </td>
                        <td>
                            <a
                                class="order-button__delete text-danger"
                                href="#"
                                rel="{{ $order->id }}"
                            >
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
                    href="{{ url('/order/create') }}"
                >
                    Добавить новый заказ
                </a>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type='text/javascript'>
        document.addEventListener('DOMContentLoaded', function() {
            const fetchData = async (url, options) => {
                const response = await fetch(`${url}`, options);
                const body = await response.json();
                return body;
            }
            const link = document.querySelectorAll('.order-button__delete');
            link.forEach(function (item) {
                item.addEventListener("click", function () {
                    if (confirm("Вы подтверждаете удаление ?")) {
                        fetchData("{{ url('/order/delete') }}/" + this.getAttribute('rel'), {
                            method: "DELETE",
                            headers: {
                                'Content-Type': 'application/json; charset=utf-8',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        }).then((Response) => {
                            alert(Response.message);
                            window.location.href = '/order';
                        })
                            .catch(() => {
                                alert(Response.message);
                                return false;
                            })
                    }
                });
            });
        });
    </script>
@endpush
