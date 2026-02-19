<?php

namespace App\Jobs;

use App\Models\Deal;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
class ProcessHubspotDeal implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public array $payload) {}

   public function handle(): void
{
    $email = $this->payload['email'] ?? null;

    if (!$email) {
        Log::warning('HubSpot webhook missing email', $this->payload);
        return;
    }

    $password = Str::random(12);

    $user = User::firstOrCreate(
    ['email' => $email],
    [
        'name' => $this->payload['dealname'] ?? 'Client',
        'password' => bcrypt($password),
    ]
);

$wasRecentlyCreated = $user->wasRecentlyCreated;

if ($wasRecentlyCreated) {
    Mail::to($user->email)->send(new WelcomeMail($user, $password));
}

    Deal::create([
        'user_id' => $user->id,
        'hubspot_deal_id' => (string) $this->payload['objectId'],
        'title' => $this->payload['dealname'] ?? null,
        'amount' => $this->payload['amount'] ?? null,
        'status' => $this->payload['eventType'] ?? null,
        'payload' => $this->payload,
    ]);

    Log::info('Deal saved', [
        'user_created' => $wasRecentlyCreated,
        'email' => $email,
    ]);
}
}
