<?php

namespace Easy\Category\Http\Controllers;

use Inertia\Response;
use Inertia\Inertia;

class EditController extends Category
{
    /**
     * Handle the incoming request.
     *
     * @param int $id
     * @return Response
     */
    public function __invoke(int $id): Response
    {
        return Inertia::render('Category/Index',[
                'categories'=> $this->tree->getTree($this->categoryModel::orderBy('sort_order', 'ASC')->select('id', 'title', 'parent_id')->get()->toArray()),
                'category' => $this->categoryModel::findOrFail($id)
            ]
        );
    }
}
