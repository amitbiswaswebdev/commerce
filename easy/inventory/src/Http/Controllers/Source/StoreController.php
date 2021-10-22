<?php

namespace Easy\Inventory\Http\Controllers\Source;

use Easy\Inventory\Http\Controllers\Source\BaseController;
use Easy\Inventory\Http\Requests\Source as SourceRequest;

class StoreController extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param SourceRequest $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(SourceRequest $request)
    {
        $this->sourceModel::create([
            'status' => $request->status,
            'title' => $request->title
        ]);
        return redirect()->route('admin.source.index')->with('success', 'New Source created');
    }
}
