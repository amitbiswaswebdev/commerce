<?php

namespace Easy\Product\Http\Controllers\Product;

use Inertia\Response;
use Inertia\Inertia;

class IndexController extends BaseController
{
    /**
     * @return Response
     */
    public function __invoke(): Response
    {
        return Inertia::render('Product/Index',[
                'types' => $this->productRepository::productType(),
                'products' => $this->productRepository->display()
            ]
        );
    }
}
