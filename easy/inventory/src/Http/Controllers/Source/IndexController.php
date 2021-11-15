<?php

namespace Easy\Inventory\Http\Controllers\Source;

use Inertia\Response;
use Inertia\Inertia;

class IndexController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function __invoke(): Response
    {
        return Inertia::render('Inventory/Source/Index',[
                'sources'=> $this->sourceRepository->getList()
            ]
        );
    }
}
