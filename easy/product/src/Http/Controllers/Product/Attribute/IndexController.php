<?php

namespace Easy\Product\Http\Controllers\Product\Attribute;

use Inertia\Response;
use Inertia\Inertia;

class IndexController extends BaseController
{
    /**
     * @return Response
     */
    public function __invoke(): Response
    {
        return Inertia::render('Product/Attribute/Index');
    }
}
