<?php

namespace App\Services\Notifications\Contracts;

interface SubscribableNotificationRepoContract {


    /**
     * @return array
     */
    public function channels();

    /**
     * @param string|null $notificationClass
     * @return array
     */
    public function notificationMeta($notificationClass = null);

    /**
     * @param $notificationClass
     * @return bool
     */
    public function hasNotification($notificationClass);

    /**
     * Filters user subscription data removing invalid notification classes and channels
     * @param array $data
     * @return array
     */
    public function filterUserSubscriptionData(array $data);
}