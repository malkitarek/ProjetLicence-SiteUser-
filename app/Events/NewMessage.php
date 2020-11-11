<?php

namespace App\Events;

use App\Message;
use App\Utilisateur;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    private $message;
    private $id;

    public function __construct(Message $message,$id)
    {
        $this->message=$message;
       $this->id=$id;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('App.User.'.$this->id);
       // return new PrivateChannel('App.User.9');
    }
    public function broadcastWith(){
        return[
          'message'=>$this->message->load([
              'from'=>function($query){
              $query->select('id','nom');
              }
          ])->toArray()
        ];
    }
}
