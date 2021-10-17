<?php

namespace Easy\Category\Http\Controllers;

use Easy\Category\Http\Controllers\Category;
use Inertia\Response;
use Inertia\Inertia;

class IndexController extends Category
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function __invoke()
    {
        return Inertia::render('Category/Index',[
            'categories'=> $this->tree->getTree($this->categoryModel::orderBy('sort_order', 'ASC')->select('id', 'title', 'parent_id')->get()->toArray())
        ]
    );
    }
}
