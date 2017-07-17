<?php


namespace App\Services\Notifications;


use App\Services\Notifications\Contracts\SubscribableNotificationRepoContract;
use App\Services\Notifications\Contracts\SubscriptionStoreContract;

class UserColumnSubscriptionStore implements SubscriptionStoreContract {

    protected $userColumn = 'notification_subscriptions';

    /**
     * @var SubscribableNotificationRepoContract
     */
    protected $repo;

    public function __construct(SubscribableNotificationRepoContract $repo, $userColumn = 'notification_subscriptions') {
        $this->repo       = $repo;
        $this->userColumn = $userColumn;
    }

    /**
     * Get subscriptions
     * @param $user
     * @return array
     */
    public function get($user) {
        return $user->{$this->userColumn};
    }

    /**
     * Set subscriptions.
     * @param $user
     * @param array $data ex: [ $notificationClass => [ 'mail', 'database'], ... ]
     * @return array
     */
    public function set($user, array $data = []) {
        $updatedData = [];
        foreach ($data as $notificationClass => $channels) {
            $updatedData = $this->repo->updateNotificationChannels($data, $notificationClass, $channels);
        }

        $user->{$this->userColumn} = $updatedData;

        return $updatedData;
    }

    /**
     * @param $user
     * @param array $data
     * @return array
     */
    public function merge($user, array $data = []) {
        $currentData = $this->get($user);
        $data        = array_replace($currentData, $data);

        return $this->set($user, $data);
    }

    /**
     * Set single subscription.
     * @param $user
     * @param string $notificationClass
     * @param array $channels ex: ['mail', 'database']
     * @return array
     */
    public function setSubscriptionChannels($user, $notificationClass, array $channels = []) {
        $data = $this->get($user);
        $data = $this->repo->updateNotificationChannels($data, $notificationClass, $channels);

        $user->{$this->userColumn} = $data;
        return $data;
    }

    /**
     * Get single subscription.
     * @param $user
     * @param string $notificationClass
     * @return array ex: ['mail', 'database']
     */
    public function getSubscriptionChannels($user, $notificationClass) {
        return array_get($this->get($user), $notificationClass, []);
    }
}