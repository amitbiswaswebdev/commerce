<?php

namespace Easy\Inventory\Http\Controllers\Source;

use Easy\Inventory\Http\Controllers\Source\BaseController;
use Inertia\Response;
use Inertia\Inertia;

class EditController extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param int $id
     * @return Response
     */
    public function __invoke($id)
    {
        return Inertia::render('Inventory/Source/Index',[
                'sources'=> $this->sourceModel::orderBy('id', 'ASC')->select('id', 'status', 'title')->paginate(3),
                'source' => $this->sourceModel::findOrFail($id)
            ]
        );
    }
}
