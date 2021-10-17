<?php

namespace Easy\Category\Http\Controllers;

use Illuminate\Http\Request;
use Easy\Category\Http\Controllers\Category;

class ReorderController extends Category
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $requestData = $request->all();
        $this->saveReorder($requestData['treeList']);
        return redirect()->back()->with('success', 'Category re-order is successful.');
    }
}
