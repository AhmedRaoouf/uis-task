<?php

namespace App\Listeners;

use App\Events\OrderStatusUpdated;
use App\Jobs\SendOrderStatusWebhookJob;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendOrderStatusWebhook
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\OrderStatusUpdated  $event
     * @return void
     */
    public function handle(OrderStatusUpdated $event)
    {
        SendOrderStatusWebhookJob::dispatch($event->order);
    }
}
