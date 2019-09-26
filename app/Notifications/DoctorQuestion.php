<?php

namespace App\Notifications;

use App\Comment;
use App\Discussion;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DoctorQuestion extends Notification implements ShouldQueue
{
    use Queueable;

    protected $discussion;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Discussion $discussion)
    {
        $this->discussion = $discussion;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $discussion = $this->discussion;

        $type = lang(substr(ucfirst('discussions'), 0, -1));

        $message = lang('Mentioned Content', [
            'user' => $discussion->doctor->name,
            'title' => $discussion->title ]);

        $url = url('discussion', ['id' => $discussion->id]);

        $data = [
            'username' => $notifiable->name,
            'message'  => $message,
            'content'  => json_decode($discussion->title),
            'url' => $url
        ];

        return (new MailMessage)
            ->subject(lang('Someone Mentioned', ['type' => strtolower($type), 'title' => $discussion->title]))
            ->markdown('mail.mention.user', $data);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return $this->discussion->toArray();
    }
}
