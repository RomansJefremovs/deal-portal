<?php

namespace App\Repositories;

use App\Models\Deal;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class DealRepository
{
    public function getAllForUser(User $user): Collection
    {
        return $user->deals()->latest()->get();
    }

    public function findForUser(User $user, string $id): Deal
    {
        return $user->deals()->findOrFail($id);
    }

    public function create(User $user, array $data): Deal
    {
        return Deal::create([
            'user_id' => $user->id,
            ...$data,
        ]);
    }
}
