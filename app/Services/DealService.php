<?php

namespace App\Services;

use App\DTOs\DealData;
use App\Models\Deal;
use App\Models\User;
use App\Repositories\DealRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DealService
{
    public function __construct(
        private DealRepository $dealRepository,
    ) {}

    public function getAllForUser(User $user): Collection
    {
        return $this->dealRepository->getAllForUser($user);
    }

    public function findForUser(User $user, string $id): Deal
    {
        return $this->dealRepository->findForUser($user, $id);
    }

    public function processFromWebhook(DealData $data): array
    {
        $password = Str::random(12);

        $user = User::firstOrCreate(
            ['email' => $data->email],
            [
                'name' => $data->title ?? 'Client',
                'password' => Hash::make($password),
            ]
        );

        $deal = $this->dealRepository->create($user, [
            'hubspot_deal_id' => $data->hubspotDealId,
            'title' => $data->title,
            'amount' => $data->amount,
            'status' => $data->status,
            'payload' => $data->payload,
        ]);

        return [
            'user' => $user,
            'deal' => $deal,
            'password' => $password,
            'user_created' => $user->wasRecentlyCreated,
        ];
    }
}
