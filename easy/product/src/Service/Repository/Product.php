<?php

namespace Easy\Product\Service\Repository;

use Illuminate\Pagination\LengthAwarePaginator;
use Easy\Product\Contracts\Repository\ProductInterface;
use Easy\Product\Models\Product as ProductModel;

/**
 * Tree
 */
class Product implements ProductInterface
{
    /**
     * construct
     *
     * @param ProductModel $product
     */
    protected ProductModel $productModel;

    /**
     * construct
     *
     * @param Product $product
     */
    public function __construct(ProductModel $productModel)
    {
        $this->productModel = $productModel;
    }

    /**
     * productType
     *
     * @return array
     */
    public static function productType() : array
    {
        return config('product_type', [
            self::SIMPLE => self::SIMPLE_LABEL
        ]);
    }

    /**
     * @inheritDoc
     **/
    public function display(array $select = self::SELECTABLE) : LengthAwarePaginator
    {
        return $this->productModel::with(
            [
              "prices" => function($q) {
                 $q->where('quantity', '=', 1);
               },
               "images" => function($q) {
                $q->where('type', '=', 'small');
              }
            ])
            ->orderBy('id', 'DESC')
            ->select($select)
            ->paginate(10);
    }

    /**
     * @inheritDoc
     */
    public function store(array $inputs) : ProductModel
    {
        return $this->storeBase($inputs);
    }

    /**
     * Store product base field
     *
     * @param array $inputs
     * @return ProductModel
     */
    protected function storeBase(array $inputs) : ProductModel
    {
        return $this->productModel::create($inputs);
    }
}
