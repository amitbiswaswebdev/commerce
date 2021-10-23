<?php

namespace Easy\Product\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    const SELECTABLE = [
        'id',
        'status',
        'sku',
        'title',
        'small_description',
        'description',
        'maintain_stock',
        'slug',
        'meta_title',
        'meta_description',
        'meta_image',
        'created_at',
        'updated_at'
    ];

    /**
     * display
     *
     * @param array $select
     * @return LengthAwarePaginator
     */
    public function display(array $select = self::SELECTABLE) : LengthAwarePaginator;
}
