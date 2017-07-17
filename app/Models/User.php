<?php

namespace App\Models;

use App\Models\Concerns\HasNotificationSubscriptions;
use App\Services\Notifications\Contracts\HasNotificationSubscriptionsContract;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements HasNotificationSubscriptionsContract {

    use Notifiable;
    use HasNotificationSubscriptions;

    protected $casts = [
        'notification_subscriptions' => 'json',
    ];
}
