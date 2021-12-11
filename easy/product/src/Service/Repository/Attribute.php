<?php

namespace Easy\Product\Service\Repository;

use Illuminate\Pagination\LengthAwarePaginator;
use Easy\Product\Contracts\Repository\AttributeInterface;
use Easy\Product\Models\ProductAttribute;

/**
 * Tree
 */
class Attribute implements AttributeInterface
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

    /**
     * @inheritDoc
     **/
    public function getById(int $id): productAttribute
    {
        return $this->productAttribute::findOrFail($id);
    }

    /**
     * @inheritDoc
     **/
    public function getList(): LengthAwarePaginator
    {
        return $this->productAttribute::orderBy('id', 'DESC')
            ->select(self::SELECTABLE)
            ->paginate(10);
    }

    /**
     * @inheritDoc
     **/
    public function store(array $inputs) : productAttribute
    {
        return $this->productAttribute::create($inputs);
    }

    /**
     * update
     *
     * @param array $inputs
     * @param int $id
     * @return productAttribute
     */
    public function update(array $inputs, int $id)
    {
        $this->productAttribute::where('id', $id)->update($inputs);
    }
}
