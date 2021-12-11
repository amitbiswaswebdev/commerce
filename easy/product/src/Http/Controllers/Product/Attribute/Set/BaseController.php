<?php

namespace Easy\Product\Http\Controllers\Product\Attribute\Set;

use App\Http\Controllers\Controller;
use Easy\Product\Contracts\Repository\{
    AttributeInterface,
    AttributeGroupInterface,
    AttributeSetInterface
};

/**
 * Category
 */
class BaseController extends Controller
{

    /**
     * Attribute Repository
     */
    protected AttributeInterface $attributeRepository;

    /**
     * Attribute Group Repository
     */
    protected AttributeGroupInterface $attributeGroupRepository;

    /**
     * Attribute Set Repository
     */
    protected AttributeSetInterface $attributeSetRepository;

    /**
     * construct
     *
     * @param AttributeInterface $attributeSetRepository
     */
    public function __construct(
        AttributeInterface $attributeRepository,
        AttributeGroupInterface $attributeGroupRepository,
        AttributeSetInterface $attributeSetRepository
    ) {
        $this->attributeRepository = $attributeRepository;
        $this->attributeGroupRepository = $attributeGroupRepository;
        $this->attributeSetRepository = $attributeSetRepository;
    }
}
