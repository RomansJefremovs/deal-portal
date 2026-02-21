<?php

namespace App\DTOs;

class DealData
{
    public function __construct(
        public readonly string $hubspotDealId,
        public readonly string $email,
        public readonly ?string $title,
        public readonly ?float $amount,
        public readonly ?string $status,
        public readonly array $payload,
    ) {}

    public static function fromPayload(array $payload): self
    {
        return new self(
            hubspotDealId: (string) $payload['objectId'],
            email: $payload['email'],
            title: $payload['dealname'] ?? null,
            amount: $payload['amount'] ?? null,
            status: $payload['eventType'] ?? null,
            payload: $payload,
        );
    }
}
