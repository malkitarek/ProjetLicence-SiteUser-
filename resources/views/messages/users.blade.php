<div class="col-md-3">
    <div class="list-group">
        @foreach($users as $user)
            <a class="list-group-item" href="{{route('conversation.show',$user->id)}}" >
                {{$user->nom}}
            </a>
        @endforeach
    </div>
</div>