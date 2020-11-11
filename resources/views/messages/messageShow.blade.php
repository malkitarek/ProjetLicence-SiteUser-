@extends('layouts.app')

@section('content')

    <div class="row">
        @include('messages.users',['users'=>$users])
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h3>{{$user->nom}}</h3>
                </div>
                <div class="card-body">
                    @foreach($messages as $message)
                        @if($message->from_id == \Illuminate\Support\Facades\Auth::user()->utilisateur->id)
                      <div class="offset-md-2 text-right">
                        <strong>Moi</strong>
                        <p style="background-color: #0000F0">{{$message->content}}</p>
                      </div>
                        <hr>
                        @else
                            <div>
                                <strong>{{$message->from->nom}}</strong>
                                <p>{{$message->content}}</p>
                            </div>
                        <hr>
                            @endauth
                    @endforeach
                    <form  method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <textarea name="content" placeholder="message envoyer" class="form-control"></textarea>
                        <button class="btn btn-primary" type="submit">Envoyer</button>

                    </form>

                </div>
            </div>
        </div>

    </div>


@endsection