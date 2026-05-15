<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;

class NewOrderNotification extends Notification
{
    use Queueable;

    public $order;

    /**
     * Recebemos o objeto Order no construtor
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Definimos que o envio será via WebPush
     */
    public function via(object $notifiable): array
    {
        return [WebPushChannel::class];
    }

    /**
     * Formatamos a mensagem que aparecerá no celular
     */
    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title('🎸 Novo Pedido!')
            ->icon('/img/logo-icon.png') // Caminho do seu ícone em public/
            ->body("{$this->order->client_name} pediu: {$this->order->song->title}")
            ->vibrate([200, 100, 200]) // Padrão de vibração do celular
            ->data(['url' => url('/dashboard')]) // URL que abre ao clicar
            ->badge('/img/badge-icon.png'); // Ícone pequeno na barra de status
    }

    /**
     * Opcional: mantém o registro no banco de dados do Laravel
     */
    public function toArray(object $notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'client_name' => $this->order->client_name,
            'song_title' => $this->order->song->title,
        ];
    }
}