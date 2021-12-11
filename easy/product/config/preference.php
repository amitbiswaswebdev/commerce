<?php

use Easy\Product\Contracts\{
    Repository\ProductInterface,
    Repository\AttributeInterface,
    Repository\AttributeGroupInterface,
    Repository\AttributeSetInterface
};

use Easy\Product\Service\{
    Repository\Attribute,
    Repository\AttributeGroup,
    Repository\AttributeSet,
    Repository\Product
};

return [
    ProductInterface::class => Product::class,
    AttributeInterface::class => Attribute::class,
    AttributeGroupInterface::class => AttributeGroup::class,
    AttributeSetInterface::class => AttributeSet::class
];
