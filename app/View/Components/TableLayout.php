<?php

namespace App\View\Components;

class TableLayout
{

    public static function makeColumn(
        string $name,
        ?string $placeholder = null,
        string $filter = '',
        $value = null,
        bool $sortable = false,
        string $class = null,
    ): array {
        return [
            'name'        => $name,
            'placeholder' => $placeholder ?? null,
            'filter'      => match ($filter) {
                'text' => 'text',
                'select' => 'select',
                'date_range' => 'date_range',
                'hidden' => 'hidden',
                default => 'no',
            },
            'value'       => $value,
            'sortable'    => $sortable,
            'class'       => $class,
        ];
    }
}
