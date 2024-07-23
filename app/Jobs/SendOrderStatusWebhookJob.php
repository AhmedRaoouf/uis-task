<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendOrderStatusWebhookJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    /**
     * Create a new job instance.
     *
     * @param $order
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $webhookUrl = env('WEBHOOK_URL');
        $data = [
            'order_id' => $this->order->id,
            'status' => $this->order->status,
        ];

        try {
            $response = Http::timeout(60)->post($webhookUrl, $data);
            Log::info('Webhook request response: ' . $response->body());
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Webhook request failed: ' . $e->getMessage());
        }
    }
}
