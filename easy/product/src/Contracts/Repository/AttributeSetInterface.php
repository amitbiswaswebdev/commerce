<?php

namespace Easy\Product\Contracts\Repository;

use Illuminate\Pagination\LengthAwarePaginator;
use Easy\Product\Models\ProductAttributeSet;
/**
 * AttributeSetInterface
 */
interface AttributeSetInterface
{
    /**
     * Product table selectable fields
     */
    const SELECTABLE = [
        'id',
        'code',
        'level',
        'created_at',
        'updated_at'
    ];

    /**
     * getById
     *
     * @param int $id
     * @return ProductAttributeSet
     */
    public function getById(int $id): ProductAttributeSet;

    /**
     * getList
     *
     * @return LengthAwarePaginator
     */
    public function getList() : LengthAwarePaginator;

    /**
     * store
     *
     * @param array $inputs
     * @return ProductAttributeSet
     */
    public function store(array $inputs) : ProductAttributeSet;

    /**
     * update
     *
     * @param array $inputs
     * @param int $id
     * @return void
     */
    public function update(array $inputs, int $id);
}
