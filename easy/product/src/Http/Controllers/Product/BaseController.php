<?php

namespace Easy\Product\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Easy\Product\Contracts\ProductRepositoryInterface;

/**
 * Category
 */
class BaseController extends Controller
{
    /**
     * productModel
     */
    protected ProductRepositoryInterface $productRepository;

    /**
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct( ProductRepositoryInterface $productRepository ) {
        $this->productRepository = $productRepository;
    }
}
