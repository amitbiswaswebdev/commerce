<?php

namespace Easy\Inventory\Http\Controllers\Source;

use Easy\Inventory\Http\Controllers\Source\BaseController;
use Easy\Inventory\Http\Requests\Source as SourceRequest;

class UpdateController extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param SourceRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function __invoke(SourceRequest $request, $id)
    {
        $this->sourceModel::where('id', $id)->update([
            'status' => $request->status,
            'title' => $request->title
        ]);
        $page = ($request->has('page')) ? $request->page : 1;
        return redirect()->route('admin.source.index',['page'=>$page])->with('success', 'Source Successfully updated');
    }
}
