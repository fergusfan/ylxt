<?php

namespace App\Notifications;

use App\Comment;
use App\Discussion;
use App\Model\OnlineMessageRoom;
use App\Model\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use phpDocumentor\Reflection\TypeResolver;

class OrderReplay extends Notification implements ShouldQueue
{
    use Queueable;

    protected $room;


    public function __construct(Order $room)
    {
        $this->room = $room;
    }


    public function via($notifiable)
    {
        return ['database', 'mail'];
    }


    public function toMail($notifiable)
    {
        $room = $this->room;

        $user = $room->user->name;

        $message = lang('Mentioned Content', [
            'user' => $user,
            'title' => '你有一条在线咨询消息',
        ]);
        $url = 'online/message/doctor/';

        $data = [
            'username' => $notifiable->name,
            'message'  => $message,
            'content'  => '你有一条在线咨询消息',
            'url' => $url
        ];

        return (new MailMessage)
            ->subject(lang('Someone Mentioned', ['type' => strtolower('order_replay'), 'title' =>'你有一条在线咨询消息']))
            ->markdown('mail.mention.user', $data);
    }

    public function toArray($notifiable)
    {
        return $this->room->toArray();
    }
}
