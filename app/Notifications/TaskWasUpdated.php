<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class TaskWasUpdated extends Notification
{
    use Queueable;

    protected $task;

    protected $post;

    /**
     * Create a new notification instance.
     *
     * @param $task
     * @param $post
     */
    public function __construct($task, $post)
    {
        //
        $this->task = $task;
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => 'Temporary placeholder'
        ];
    }
}
