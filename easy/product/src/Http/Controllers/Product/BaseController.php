<?php

namespace Easy\Product\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Easy\Product\Contracts\Repository\ProductInterface;
use Easy\Inventory\Models\Source as SourceModel;

/**
 * Category
 */
class BaseController extends Controller
{
    /**
     * product repository
     */
    protected ProductInterface $productRepository;

    /**
     * construct
     *
     * @param ProductInterface $productRepository
     * @param SourceModel $sourceModel
     */
    public function __construct(
        ProductInterface $productRepository,
        SourceModel $sourceModel
    ) {
        $this->productRepository = $productRepository;
    }
}
