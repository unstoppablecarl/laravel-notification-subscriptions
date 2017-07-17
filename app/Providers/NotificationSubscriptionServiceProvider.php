<?php


namespace App\Providers;


use App\Notifications\InvoicePaid;
use App\Services\Notifications\Contracts\SubscribableNotificationRepoContract;
use App\Services\Notifications\Contracts\SubscriptionStoreContract;
use App\Services\Notifications\SubscribableNotificationRepo;
use App\Services\Notifications\UserColumnSubscriptionStore;
use Illuminate\Support\ServiceProvider;

class NotificationSubscriptionServiceProvider extends ServiceProvider {

    public function register() {

        $this->app->bind(SubscribableNotificationRepoContract::class, function($app){
            $channels = ['database'];
            $classes = [
                InvoicePaid::class
            ];
            return new SubscribableNotificationRepo($classes, $channels);
        });

        $this->app->bind(SubscriptionStoreContract::class, UserColumnSubscriptionStore::class);

    }
}