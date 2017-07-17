<?php

namespace App\Models\Concerns;

use App;
use App\Services\Notifications\Contracts\SubscriptionStoreContract;

/**
 * Trait HasNotificationSubscriptions
 * Intended to be added to User model class
 * @package App\Services\Notifications
 */
trait HasNotificationSubscriptions {

    /**
     * @return SubscriptionStoreContract
     */
    protected function notificationSubscriptionStore() {
        return App::make(SubscriptionStoreContract::class);
    }

    public function getNotificationSubscriptions() {
        return $this->notificationSubscriptionStore()
                    ->get($this);
    }

    public function setNotificationSubscriptions(array $data = []) {
        return $this->notificationSubscriptionStore()
                    ->set($this, $data);
    }

    public function setNotificationSubscriptionChannels($notificationClass, array $channels = []) {
        return $this->notificationSubscriptionStore()
                    ->setSubscriptionChannels($this, $notificationClass, $channels);
    }

    public function getNotificationSubscriptionChannels($notificationClass) {
        return $this->notificationSubscriptionStore()
                    ->getSubscriptionChannels($this, $notificationClass);

    }

}