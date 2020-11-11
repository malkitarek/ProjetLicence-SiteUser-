@extends('layouts.app')
@section('sedibar')
    @include('menu.sidebar')
@endsection

@section('content')
    <div class="container">
        <div class="row">

        @include('posts.input_post')
        @include('posts.index_post');

        </div>
    </div>
@endsection
