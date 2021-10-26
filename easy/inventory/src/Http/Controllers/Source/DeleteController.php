<?php

namespace Easy\Inventory\Http\Controllers\Source;

use Illuminate\Http\RedirectResponse;

class DeleteController extends BaseController
{
    /**
     * Delete Category
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function __invoke($id): RedirectResponse
    {
        $source = $this->sourceModel::where('id', $id)->first();
        $source->delete();
        return redirect()->route('admin.source.index')->with('success', 'Source deleted successfully.');

    }
}
