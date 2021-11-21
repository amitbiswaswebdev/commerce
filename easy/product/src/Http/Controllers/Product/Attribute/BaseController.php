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
