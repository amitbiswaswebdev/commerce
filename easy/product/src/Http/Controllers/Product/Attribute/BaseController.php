<?php

namespace Easy\Product\Http\Controllers\Product\Attribute;

use App\Http\Controllers\Controller;
use Easy\Product\Contracts\Repository\AttributeInterface;

/**
 * Category
 */
class BaseController extends Controller
{
    /**
     * type of attributes
     */
    const TYPE = [
        'text',
        'number',
        'textarea',
        'toggle',
        'date',
        'text-select',
        'color-select',
        'visual-select',
        'multi-select',
        'image',
        'file'
    ];

    /**
     * Attribute Repository
     */
    protected AttributeInterface $attributeRepository;

    /**
     * construct
     *
     * @param AttributeInterface $attributeRepository
     */
    public function __construct(
        AttributeInterface $attributeRepository
    ) {
        $this->attributeRepository = $attributeRepository;
    }
}
