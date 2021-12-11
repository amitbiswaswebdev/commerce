<?php

namespace Easy\Product\Contracts\Repository;

use Illuminate\Pagination\LengthAwarePaginator;
use Easy\Product\Models\ProductAttributeGroup;
/**
 * AttributeGroupInterface
 */
interface AttributeGroupInterface
{
    /**
     * Product table selectable fields
     */
    const SELECTABLE = [
        'id',
        'code',
        'level',
        'set_code',
        'created_at',
        'updated_at'
    ];

    /**
     * getById
     *
     * @param int $id
     * @return ProductAttributeGroup
     */
    public function getById(int $id): ProductAttributeGroup;

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
     * @return ProductAttributeGroup
     */
    public function store(array $inputs) : ProductAttributeGroup;

    /**
     * update
     *
     * @param array $inputs
     * @param int $id
     * @return void
     */
    public function update(array $inputs, int $id);
}
