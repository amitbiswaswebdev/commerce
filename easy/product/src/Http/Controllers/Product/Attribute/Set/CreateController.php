<?php

namespace Easy\Product\Http\Controllers\Product\Attribute\Set;

use Inertia\Response;
use Inertia\Inertia;

class CreateController extends BaseController
{
    /**
     * invoke
     *
     * @return Response
     */
    public function __invoke(): Response
    {
        return Inertia::render('Product/Attribute/Set/Create');
    }
}
