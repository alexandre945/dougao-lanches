<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use App\Http\Models\oder;
use NotificationChannels\Twilio\TwilioSmsMessage;

class NewOrderNotification extends Notification
{
    protected $order;



    public function __construct($order)
        {
            $this->order = $order;
        }


    public function via($notifiable)
       {

   return ['twilio'];

       }
    public function toTwilio($notifiable)
       {
        return (new TwilioSmsMessage())
            ->content("Novo pedido! ID: {$this->order->id}. Total R$ {$this->order->total}");
       }


}
