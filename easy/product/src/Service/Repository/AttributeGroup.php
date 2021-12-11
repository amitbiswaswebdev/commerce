<?php

namespace Easy\Product\Service\Repository;

use Illuminate\Pagination\LengthAwarePaginator;
use Easy\Product\Contracts\Repository\AttributeGroupInterface;
use Easy\Product\Models\ProductAttributeGroup;

/**
 * Tree
 */
class AttributeGroup implements AttributeGroupInterface
{
    /**
     * construct
     *
     * @param ProductAttributeGroup $productAttributeGroup
     */
    protected ProductAttributeGroup $productAttributeGroup;

    /**
     * construct
     *
     * @param ProductAttributeGroup $productAttributeGroup
     */
    public function __construct(ProductAttributeGroup $productAttributeGroup)
    {
        $this->productAttributeGroup = $productAttributeGroup;
    }

    /**
     * @inheritDoc
     **/
    public function getById(int $id): ProductAttributeGroup
    {
        return $this->productAttributeGroup::findOrFail($id);
    }

    /**
     * @inheritDoc
     **/
    public function getList(): LengthAwarePaginator
    {
        return $this->productAttributeGroup::orderBy('id', 'DESC')
            ->select(self::SELECTABLE)
            ->paginate(10);
    }

    /**
     * @inheritDoc
     **/
    public function store(array $inputs) : ProductAttributeGroup
    {
        return $this->productAttributeGroup::create($inputs);
    }

    /**
     * update
     *
     * @param array $inputs
     * @param int $id
     * @return ProductAttributeGroup
     */
    public function update(array $inputs, int $id)
    {
        $this->productAttributeGroup::where('id', $id)->update($inputs);
    }
}
