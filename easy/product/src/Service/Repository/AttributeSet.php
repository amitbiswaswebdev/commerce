<?php

namespace Easy\Product\Service\Repository;

use Illuminate\Pagination\LengthAwarePaginator;
use Easy\Product\Contracts\Repository\AttributeSetInterface;
use Easy\Product\Models\ProductAttributeSet;

/**
 * Tree
 */
class AttributeSet implements AttributeSetInterface
{
    /**
     * construct
     *
     * @param ProductAttributeSet $productAttributeSet
     */
    protected ProductAttributeSet $productAttributeSet;

    /**
     * construct
     *
     * @param ProductAttributeSet $productAttributeSet
     */
    public function __construct(ProductAttributeSet $productAttributeSet)
    {
        $this->productAttributeSet = $productAttributeSet;
    }

    /**
     * @inheritDoc
     **/
    public function getById(int $id): ProductAttributeSet
    {
        return $this->productAttributeSet::findOrFail($id);
    }

    /**
     * @inheritDoc
     **/
    public function getList(): LengthAwarePaginator
    {
        return $this->productAttributeSet::orderBy('id', 'DESC')
            ->select(self::SELECTABLE)
            ->paginate(10);
    }

    /**
     * @inheritDoc
     **/
    public function store(array $inputs) : ProductAttributeSet
    {
        return $this->productAttributeSet::create($inputs);
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
        $this->productAttributeSet::where('id', $id)->update($inputs);
    }
}
