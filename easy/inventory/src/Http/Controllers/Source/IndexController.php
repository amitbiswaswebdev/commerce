<?php

namespace Easy\Inventory\Http\Controllers\Source;

use Easy\Inventory\Http\Controllers\Source\BaseController;
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
        return Inertia::render('Inventory/Source/Index',[
                'sources'=> $this->sourceModel::orderBy('id', 'ASC')->select('id', 'title')->get()
            ]
        );
    }
}
