<?php

namespace Easy\Product\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Easy\Product\Contracts\ProductRepositoryInterface;
use Easy\Inventory\Models\Source as SourceModel;

/**
 * Category
 */
class BaseController extends Controller
{
    /**
     * product repository
     */
    protected ProductRepositoryInterface $productRepository;

    /**
     * construct
     *
     * @param ProductRepositoryInterface $productRepository
     * @param SourceModel $sourceModel
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        SourceModel $sourceModel
    ) {
        $this->productRepository = $productRepository;
    }
}
