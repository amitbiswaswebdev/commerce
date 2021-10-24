<?php

namespace Easy\Product\Http\Controllers\Product\Simple;

use Easy\Product\Http\{
    Controllers\Product\BaseController,
    Requests\Product as ProductRequest
};

class StoreController extends BaseController
{
    /**
     * invoke
     *
     * @param ProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ProductRequest $request)
    {
        $inputs = $request->all();
        $inputs['type'] = $this->productRepository::SIMPLE;
        $this->productRepository->store($inputs);
        return redirect()->route('admin.product.index')->with('success', 'New Product created');
    }
}
