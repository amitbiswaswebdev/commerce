<?php

namespace Easy\Product\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;

/**
 * AttributeRepositoryInterface
 */
interface AttributeRepositoryInterface
{
    /**
     * Product table selectable fields
     */
    const SELECTABLE = [
        'id',
        'code',
        'level',
        'input',
        'validation_rules',
        'user_defined',
        'default_value',
        'model_value',
        'use_in_filter',
        'show_as',
        'created_at',
        'updated_at'
    ];

    public function getList() : LengthAwarePaginator;
}
