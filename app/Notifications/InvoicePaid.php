<?php

namespace App\Notifications;

use App\Models\Concerns\HasNotificationSubscriptions;
use App\Models\Invoice;
use App\Notifications\Concerns\UserSubscribableNotification;
use Illuminate\Notifications\Notification;

class InvoicePaid extends Notification {

    use UserSubscribableNotification;

    static protected $channels    = ['database'];
    static protected $displayName = 'Invoice Paid';
    static protected $description = 'When an invoice is paid';

    /**
     * @var Invoice
     */
    protected $invoice;

    /**
     * Create a new notification instance.
     * @param Invoice $invoice
     */
    public function __construct(Invoice $invoice) {
        $this->invoice = $invoice;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable) {
        if($notifiable instanceof HasNotificationSubscriptions){
            return $notifiable->getNotificationSubscriptionChannels(__CLASS__);
        }
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable) {
        return $this->invoice->toArray();
    }
}
