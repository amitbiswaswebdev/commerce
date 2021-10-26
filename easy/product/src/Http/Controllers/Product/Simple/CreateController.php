<?php

namespace Easy\Product\Http\Controllers\Product\Simple;

use Inertia\Response;
use Inertia\Inertia;
use Easy\Product\Http\Controllers\Product\BaseController;

class CreateController extends BaseController
{
    /**
     * @return Response
     */
    public function __invoke(): Response
    {
        return Inertia::render('Product/Simple/Create');
    }
}
