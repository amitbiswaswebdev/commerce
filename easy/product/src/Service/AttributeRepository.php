<?php

namespace Easy\Product\Service;

use Illuminate\Pagination\LengthAwarePaginator;
use Easy\Product\Contracts\AttributeRepositoryInterface;
use Easy\Product\Models\ProductAttribute;

/**
 * Tree
 */
class AttributeRepository implements AttributeRepositoryInterface
{
    /**
     * construct
     *
     * @param ProductAttribute $productAttribute
     */
    protected ProductAttribute $productAttribute;

    /**
     * construct
     *
     * @param ProductAttribute $productAttribute
     */
    public function __construct(ProductAttribute $productAttribute)
    {
        $this->productAttribute = $productAttribute;
    }

    public function getList() : LengthAwarePaginator {
        return $this->productAttribute::orderBy('id', 'DESC')
            ->select(self::SELECTABLE)
            ->paginate(10);
    }
}
