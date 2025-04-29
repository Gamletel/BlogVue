<?php

namespace App\Events;

use App\Models\UserComment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class CommentCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $comment;

    /**
     * Create a new event instance.
     */
    public function __construct(UserComment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('user.'.$this->comment->post->user_id),
        ];
    }

    public function broadcastWith()
    {
        return [
            'message'=>$this->comment->user->name . ' оставил комментарий на вашем посте',
            'data'=>[
                'post_id'=>$this->comment->post_id,
                'post_title'=>$this->comment->post->title,
                'comment_id'=>$this->comment->id,
                'comment_preview'=>Str::limit($this->comment->text, 50),
            ]
        ];
    }
}
