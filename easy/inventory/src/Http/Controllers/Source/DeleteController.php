<?php

namespace Easy\Inventory\Http\Controllers\Source;

use Inertia\Response;
use Easy\Inventory\Http\Controllers\Source\BaseController;
class DeleteController extends BaseController
{
    /**
     * Delete Category
     *
     * @param int $id
     * @return Response
     */
    public function __invoke($id)
    {
        $source = $this->sourceModel::where('id', $id)->first();
        $source->delete();
        return redirect()->route('admin.source.index')->with('success', 'Source deleted successfully.');

    }
}
