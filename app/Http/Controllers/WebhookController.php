<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {

        Log::debug('Webhook received:', $request->all());
        return response()->json(['message' => 'Webhook received successfully'], 200);
    }
}
