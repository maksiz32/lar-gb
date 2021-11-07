@extends('layouts.app')
@section('title', "Курсы валют")

@section('content')
    @if(count($valutas) < 1)
        <div class="alert alert-warning" role="alert">
            Нет записей в данной категории
        </div>
    @else
        <div class="container lar-main">
            <div class="row justify-content-center">
                <h2>{{ __("Курсы валют") }}</h2>
                @foreach($valutas as $valuta)
                    <div class="card m-4" style="width: 14rem; box-shadow: 2px 2px 10px darkgray">
                        <div class="card-body text-center">
                            <div class="card-header">
                                {{ $valuta['CharCode'] }}
                            </div>
                            <div class="card-title">{{ $valuta['Name'] }}</div>
                            <p class="card-text">
                                За {{ $valuta['Nominal'] }} руб.
                            </p>
                            <p class="card-text">
                                {{ $valuta['Value'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endempty
@endsection
