<?php

namespace App\Notifications;

use App\Comment;
use App\Discussion;
use App\Model\Advice;
use App\Model\OnlineMessageRoom;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use phpDocumentor\Reflection\TypeResolver;

class AdviceMessage extends Notification implements ShouldQueue
{
    use Queueable;

    protected $advice;
    protected $type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Advice $advice,$type)
    {
        $this->advice = $advice;
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
        $advice = $this->advice;
        $type = $this->type;
        $user = $advice->user->name;
        if($type ==1){
            $user = $advice->doctor->name;
        }
        $message = lang('Mentioned Content', [
            'user' => $user,
            'title' => '你有一条在线咨询消息',
        ]);
        $url = 'online/message/doctor/'.$advice->doctor->id.'?room_id='.$advice->id;

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
        return $this->advice->toArray();
    }
}
