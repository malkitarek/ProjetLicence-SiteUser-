@extends('layouts.app')

@section('content')

  <Messagerie :user="{{\Illuminate\Support\Facades\Auth::user()->utilisateur->id}}"
              :user1="{{\Illuminate\Support\Facades\Auth::user()->id}}"
             :user2="{{\Illuminate\Support\Facades\Auth::user()->utilisateur->id}}"></Messagerie>


@endsection