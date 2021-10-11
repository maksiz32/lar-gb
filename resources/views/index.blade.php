@extends('layouts.app')
@section('title', $page_title)
@section('content')
    <article class="container-fluid">
        @foreach($news as $new)
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{$new['title']}}</h5>
                <p class="card-text">{{$new['text']}}</p>
            </div>
        </div>
        @endforeach
    </article>
    <footer>{{$description}}</footer>
@endsection
