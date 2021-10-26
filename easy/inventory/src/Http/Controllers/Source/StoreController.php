<?php

namespace Easy\Inventory\Http\Controllers\Source;

use Easy\Inventory\Http\Requests\Source as SourceRequest;
use Illuminate\Http\RedirectResponse;

class StoreController extends BaseController
{

    /**
     * @param SourceRequest $request
     * @return RedirectResponse
     */
    public function __invoke(SourceRequest $request): RedirectResponse
    {
        $this->sourceModel::create([
            'status' => $request->status,
            'title' => $request->title
        ]);
        return redirect()->route('admin.source.index')->with('success', 'New Source created');
    }
}
