<?php


namespace App\Services\Notifications\Contracts;

interface HasNotificationSubscriptionsContract {

    public function getNotificationSubscriptions();

    public function setNotificationSubscriptions(array $data = []);

    public function setNotificationSubscriptionChannels($notificationClass, array $channels = []);

    public function getNotificationSubscriptionChannels($notificationClass);
}