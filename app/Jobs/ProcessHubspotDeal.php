<?php

namespace App\Jobs;

use App\DTOs\DealData;
use App\Mail\WelcomeMail;
use App\Services\DealService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ProcessHubspotDeal implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public array $payload) {}

    public function handle(DealService $dealService): void
    {
        $email = $this->payload['email'] ?? null;

        if (!$email) {
            Log::warning('HubSpot webhook missing email', $this->payload);
            return;
        }

        $data = DealData::fromPayload($this->payload);

        $result = $dealService->processFromWebhook($data);

        if ($result['user_created']) {
            Mail::to($result['user']->email)->send(
                new WelcomeMail($result['user'], $result['password'])
            );
        }

        Log::info('Deal processed', [
            'user_created' => $result['user_created'],
            'email' => $email,
        ]);
    }
}
