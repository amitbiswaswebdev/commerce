<?php

namespace Easy\Category\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReorderController extends Category
{
    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $requestData = $request->all();
        $this->saveReorder($requestData['treeList']);
        return redirect()->back()->with('success', 'Category re-order is successful.');
    }
}
