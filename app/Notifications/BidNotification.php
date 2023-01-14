<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class BidNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public $ar_message;
    public $en_message;
    public $url;

    public function __construct($ar_message,$en_mesage,$url)
    {
        $this->ar_message=$ar_message;
        $this->en_message=$en_mesage;
        $this->url=$url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        //['database','broadcast'] for real time
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        $mytime = Carbon::now();
        $start=strtotime($mytime);
        return [
            'ar' => $this->ar_message ,
            'en' => $this->en_message,
            'url' => $this->url,
        ];
    }

    public function toBroadcast($notifiable)
    {
        //for real time notfication
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
            //
        ];
    }
}
