<?php

namespace Easy\Product\Http\Controllers\Product;

use Inertia\Response;
use Inertia\Inertia;
use Easy\Product\Http\Controllers\Product\BaseController;
class IndexController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function __invoke()
    {
        return Inertia::render('Product/Index',[
                'types' => $this->productRepository::productType(),
                'products' => $this->productRepository->display()
            ]
        );
    }
}
