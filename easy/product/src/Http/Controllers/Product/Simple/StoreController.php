<?php

namespace Easy\Product\Http\Controllers\Product\Simple;

use Easy\Product\Http\{
    Controllers\Product\BaseController,
    Requests\Product as ProductRequest
};
use Illuminate\Http\RedirectResponse;

class StoreController extends BaseController
{
    /**
     * @param ProductRequest $request
     * @return RedirectResponse
     */
    public function __invoke(ProductRequest $request): RedirectResponse
    {
        $inputs = $request->all();
        $inputs['type'] = $this->productRepository::SIMPLE;
        $this->productRepository->store($inputs);
        return redirect()->route('admin.product.index')->with('success', 'New Product created');
    }
}
