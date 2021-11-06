@extends('layouts.app')
@section('title', $feedback->title)

@section('content')
    <div class="container lar-main">
        <div class="row justify-content-center">
            <div class="card m-2" style="width: 38rem;">
                <div class="card-body">
                    <div class="card-text border-bottom pb-4">
                        {{ $feedback->comment }}
                    </div>
                    <div class="card-subtitle pb-4">
                        <small class="text-muted font-monospace">
                            {{ __('дата: ' . $feedback->created_at->format('d M Y H:i')) }}
                        </small>
                            {{"Автор: $feedback->user_name "}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
