<?php

namespace App\Services;

use App\Exceptions\Users\InsufficientFundsException;
use App\Models\User;
use App\Models\UserBalance;
use Illuminate\Database\Eloquent\Model;

class UserService
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @throws \App\Exceptions\Users\InsufficientFundsException
     */
    public function updateBalance(Model $entity, float $amount, $description = null): void
    {

        $this->initUserBalance();

        $userBalance = UserBalance::query()->where(['user_id' => $this->user->id])->first();

        if ($userBalance->balance + $amount < 0) {
            throw new InsufficientFundsException();
        }

        $oldBalance = $userBalance->balance;

        $userBalance->increment('balance', $amount);

        $userBalance->refresh();

        $this->user->balanceHistory()->forceCreate([
            'entity_type'     => get_class($entity),
            'entity_id'       => $entity->getKey(),
            'amount'          => $amount,
            'balance'         => $userBalance->balance,
            'old_balance'     => $oldBalance,
            'description'     => $description,
            'user_balance_id' => $userBalance->id,
        ]);

    }

    public function initUserBalance(): void
    {
        if (!$this->user->balance()->exists()) {
            $balance = new UserBalance();
            $balance->user()->associate($this->user);
            $balance->balance = 0;
            $balance->save();
        }
    }
}
