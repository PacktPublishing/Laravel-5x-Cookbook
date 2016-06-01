<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handleWebhook()
    {
        $payload = $this->getJsonPayload();

        Log::info("Webhook from Stripe");
        Log::info(print_r($payload, 1));
        parent::handleWebhook();
    }
}