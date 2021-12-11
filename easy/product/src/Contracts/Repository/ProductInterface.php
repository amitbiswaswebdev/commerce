<?php

namespace Easy\Product\Contracts\Repository;

use Illuminate\Pagination\LengthAwarePaginator;
use Easy\Product\Models\Product;

interface ProductInterface
{

    /**
     * simple product type
     */
    const SIMPLE = 'simple';

    /**
     * simple product type label
     */
    const SIMPLE_LABEL = 'Simple Product';

    /**
     * Product table selectable fields
     */
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
     * productType
     *
     * @return array
     */
    public static function productType() : array;

    /**
     * display
     *
     * @param array $select
     * @return LengthAwarePaginator
     */
    public function display(array $select = self::SELECTABLE) : LengthAwarePaginator;

    /**
     * Store Simple Product
     *
     * @param array $inputs
     * @return Product
     */
    public function store(array $inputs) : Product;

}
