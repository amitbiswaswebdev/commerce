<?php

namespace Easy\Product\Service;

use Illuminate\Pagination\LengthAwarePaginator;
use Easy\Product\Contracts\ProductRepositoryInterface;
use Easy\Product\Models\Product;

/**
 * Tree
 */
class ProductRepository implements ProductRepositoryInterface
{
    /**
     * construct
     *
     * @param Product $product
     */
    protected Product $product;

    /**
     * construct
     *
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
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
        return $this->product::with(
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
    public function store(array $inputs) : Product
    {
        return $this->storeBase($inputs);
    }

    /**
     * Store product base field
     *
     * @param array $inputs
     * @return Product
     */
    protected function storeBase(array $inputs) : Product
    {
        return $this->product::create($inputs);
    }
}
