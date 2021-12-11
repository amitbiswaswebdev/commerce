<?php

namespace Easy\Product\Contracts\Repository;

use Illuminate\Pagination\LengthAwarePaginator;
use Easy\Product\Models\ProductAttribute;
/**
 * AttributeInterface
 */
interface AttributeInterface
{
    /**
     * Product table selectable fields
     */
    const SELECTABLE = [
        'id',
        'code',
        'level',
        'input',
        'required',
        'validations',
        'user_defined',
        'default_value',
        'options',
        'model_value',
        'show_in_frontend_features',
        'use_in_filter',
        'created_at',
        'updated_at'
    ];

    /**
     * getById
     *
     * @param int $id
     * @return productAttribute
     */
    public function getById(int $id): productAttribute;

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
     * @return productAttribute
     */
    public function store(array $inputs) : productAttribute;

    /**
     * update
     *
     * @param array $inputs
     * @param int $id
     * @return void
     */
    public function update(array $inputs, int $id);
}
