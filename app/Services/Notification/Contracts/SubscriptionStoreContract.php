<?php


namespace App\Services\Notifications\Contracts;


interface SubscriptionStoreContract {

    /**
     * Get subscriptions
     * @param $user
     * @return array
     */
    public function get($user);

    /**
     * Set subscriptions.
     * @param $user
     * @param array $data ex: [ $notificationClass => [ 'mail', 'database'], ... ]
     * @return array
     */
    public function set($user, array $data = []);

    /**
     * Merge new subscription data into existing
     * @param $user
     * @param array $data
     * @return array
     */
    public function merge($user, array $data = []);

    /**
     * Set single subscription.
     * @param $user
     * @param string $notificationClass
     * @param array $channels ex: ['mail', 'database']
     * @return
     */
    public function setSubscriptionChannels($user, $notificationClass, array $channels = []);

    /**
     * Get single subscription.
     * @param $user
     * @param string $notificationClass
     * @return array ex: ['mail', 'database']
     */
    public function getSubscriptionChannels($user, $notificationClass);

}