<?php

namespace App\Services\Notifications;

use App\Services\Notifications\Contracts\SubscribableNotificationRepoContract;

class SubscribableNotificationRepo implements SubscribableNotificationRepoContract {

    /**
     * Notification classes that can be subscribed to.
     * @var array
     */
    protected $notificationMeta = [];

    /**
     * Channels supported by application.
     * @var array
     */
    protected $channels = [];

    /**
     * SubscribableNotificationRepo constructor.
     * @param array $notificationClasses
     * @param array $channels
     */
    public function __construct(array $notificationClasses = [], array $channels = []) {
        $this->channels = $channels;

        foreach ($notificationClasses as $class) {
            $this->addNotificationClass($class);
        }
    }

    public function addNotificationClass($class) {
        if (!class_exists($class)) {
            return;
        }

        $this->notificationMeta[$class] = [
            'class'        => $class,
            'display_name' => $class::displayName(),
            'description'  => $class::description(),
            'channels'     => array_intersect($class::channels(), $this->channels),
        ];
    }

    public function channels() {
        return $this->channels;
    }

    /**
     * @param null $notificationClass
     * @return array
     */
    public function notificationMeta($notificationClass = null) {
        if ($notificationClass) {
            return array_get($this->notificationMeta, $notificationClass, []);
        }
        return $this->notificationMeta;
    }

    public function hasNotification($notificationClass) {
        return (bool)$this->notificationMeta[$notificationClass];
    }

    public function validNotificationChannels($notificationClass) {
        $key = $notificationClass . '.channels';
        return array_get($this->notificationMeta(), $key, []);
    }

    public function filterUserSubscriptionData(array $data) {

        $newData = [];

        foreach ($data as $notificationClass => $channels) {
            if (!$this->hasNotification($notificationClass)) {
                continue;
            }

            $validChannels = $this->validNotificationChannels($notificationClass);
            $channels      = array_intersect($validChannels, $channels);

            if ($channels) {
                $newData[$notificationClass] = $channels;
            }
        }

        return $newData;
    }

}