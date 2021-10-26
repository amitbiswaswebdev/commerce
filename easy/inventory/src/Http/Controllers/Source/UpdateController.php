<?php

namespace Easy\Inventory\Http\Controllers\Source;

use Easy\Inventory\Http\Requests\Source as SourceRequest;
use Illuminate\Http\RedirectResponse;

class UpdateController extends BaseController
{
    /**
     * @param SourceRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function __invoke(SourceRequest $request, $id): RedirectResponse
    {
        $this->sourceModel::where('id', $id)->update([
            'status' => $request->status,
            'title' => $request->title
        ]);
        $page = ($request->has('page')) ? $request->page : 1;
        return redirect()->route('admin.source.index',['page'=>$page])->with('success', 'Source Successfully updated');
    }
}
