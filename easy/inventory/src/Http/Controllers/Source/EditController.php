<?php

namespace Easy\Inventory\Http\Controllers\Source;

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
    public function __invoke(int $id): Response
    {
        return Inertia::render('Inventory/Source/Index',[
                'sources'=> $this->sourceModel::orderBy('id', 'DESC')->select('id', 'status', 'title')->paginate(3),
                'source' => $this->sourceModel::findOrFail($id)
            ]
        );
    }
}
