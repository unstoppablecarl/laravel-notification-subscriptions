<?php

namespace App\Notifications\Concerns;

trait UserSubscribableNotification {

    /**
     * @var array
     */
    static protected $channels = [];

    /**
     * @var string
     */
    static protected $displayName;

    /**
     * @var string
     */
    static protected $description;

    /**
     * @return string
     */
    static public function displayName() {
        return static::$displayName;
    }

    /**
     * @return string
     */
    static public function description() {
        return static::$description;
    }

    /**
     * @return array
     */
    static public function channels(){
        return static::$channels;
    }
}