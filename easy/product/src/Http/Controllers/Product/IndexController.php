<?php

namespace Easy\Product\Http\Controllers\Product;

use Easy\Product\Http\Controllers\Product\BaseController;
use Inertia\Response;
use Inertia\Inertia;

class IndexController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function __invoke()
    {
        return Inertia::render('Product/Index',[
                'products' => $this->productRepository->display()
            ]
        );
    }
}
