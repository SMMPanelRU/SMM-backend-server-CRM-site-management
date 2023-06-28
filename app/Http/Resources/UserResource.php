<?php

namespace App\Http\Resources;

use App\Enum\DefaultStatusEnum;
use App\Models\Product;
use App\Models\User;
use App\Services\SiteContainer;
use App\Traits\EntityAttributeTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    use EntityAttributeTrait;

    private int $id;
    private string $name;
    private string $email;
    private DefaultStatusEnum $status;
    private float $balance;
    private array $profile;

    public function __construct(User $user)
    {
        parent::__construct($user);

        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->status = $user->status;
        $this->balance = $user->balance->balance;
        $this->profile = []; // $user->profile();

    }

    public function toArray($request): array
    {
        return [
            'id'      => $this->id,
            'name'    => $this->name,
            'email'   => $this->email,
            'status'  => $this->status,
            'balance' => $this->balance,
            'profile' => $this->profile,
        ];
    }
}
