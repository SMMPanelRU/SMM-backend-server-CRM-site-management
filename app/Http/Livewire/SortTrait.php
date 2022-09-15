<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait SortTrait
{
    public function sortItems(Builder|BelongsToMany $query, $sortData = []): Collection|LengthAwarePaginator|array
    {

        $limit    = (int) ($sortData['limit'] ?? 10);
        $orderBy  = $sortData['orderBy'] ?? 'id';
        $orderDir = $sortData['orderDir'] ?? 'desc';

        if ($limit === -1) {
            return $query->orderBy($orderBy, $orderDir)->get();
        } else {
            return $query->orderBy($orderBy, $orderDir)->paginate($limit);
        }

    }
}
