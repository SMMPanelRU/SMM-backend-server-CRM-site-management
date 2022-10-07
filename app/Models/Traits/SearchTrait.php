<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

trait SearchTrait
{
    public function scopeSearch(Builder $query, $data = []): void
    {

        if ($this->searchFields ?? null) {
            foreach ($this->searchFields as $k => $searchType) {
                if (in_array($k, array_keys($data))) {

                    $value = strtolower($data[$k]);

                    if ($value == '') {
                        continue;
                    }

                    if ($searchType === 'date') {
                        if (str_contains($value, ' to ')) {
                            $dates    = explode(' to ', $value);
                            $fromDate = $dates[0];
                            $toDate   = $dates[1];
                        } else {
                            $fromDate = $toDate = $value;
                        }

                        $query->whereBetween($k, [Carbon::createFromDate($fromDate)->startOfDay(), Carbon::createFromDate($toDate)->endOfDay()]);
                    }

                    if ($searchType === 'match') {
                        if ($this->translatable && in_array($k, $this->translatable)) {
                            $query->where(function ($query) use ($k, $value) {
                                foreach (config('app.locales') as $locale) {
                                    $query->orWhere(DB::raw("lower({$k}->\"$.{$locale}\")"), 'LIKE', "%{$value}%");
                                }
                            });
                        } else {
                            $query->where($k, $value);
                        }
                    }

                    if ($searchType === 'like') {
                        if ($this->translatable && in_array($k, $this->translatable)) {
                            $query->where(function ($query) use ($k, $value) {
                                foreach (config('app.locales') as $locale) {
                                    $query->orWhere(DB::raw("lower({$k}->\"$.{$locale}\")"), 'LIKE', "%{$value}%");
                                }
                            });
                        } else {
                            $query->where($k, 'LIKE', "%{$value}%");
                        }

                    }
                }
            }
        }
    }
}
