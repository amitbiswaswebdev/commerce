<?php

namespace Easy\Product\Http\Controllers\Product\Attribute;

use App\Http\Controllers\Controller;
use Easy\Product\Contracts\AttributeRepositoryInterface;

/**
 * Category
 */
class BaseController extends Controller
{
    /**
     * Attribute Repository
     */
    protected AttributeRepositoryInterface $attributeRepository;

    /**
     * construct
     *
     * @param AttributeRepositoryInterface $attributeRepository
     */
    public function __construct(
        AttributeRepositoryInterface $attributeRepository
    ) {
        $this->attributeRepository = $attributeRepository;
    }
}
