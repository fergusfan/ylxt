<?php

namespace App\Notifications;

use App\Comment;
use App\Discussion;
use App\Model\OnlineMessageRoom;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use phpDocumentor\Reflection\TypeResolver;

class OnlineMessage extends Notification implements ShouldQueue
{
    use Queueable;

    protected $room;
    protected $type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(OnlineMessageRoom $room,$type)
    {
        $this->room = $room;
        $this->type = $type;
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


    public function toMail($notifiable)
    {
        $room = $this->room;
        $type = $this->type;
        $user = $room->user->name;
        if($type ==1){
            $user = $room->doctor->name;
        }
        $message = lang('Mentioned Content', [
            'user' => $user,
            'title' => '你有一条在线咨询消息',
        ]);
        $url = 'online/message/doctor/'.$room->doctor->id.'?room_id='.$room->id;

        $data = [
            'username' => $notifiable->name,
            'message'  => $message,
            'content'  => '你有一条在线咨询消息',
            'url' => $url
        ];

        return (new MailMessage)
            ->subject(lang('Someone Mentioned', ['type' => strtolower($type), 'title' =>'你有一条在线咨询消息']))
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
        return $this->room->toArray();
    }
}
