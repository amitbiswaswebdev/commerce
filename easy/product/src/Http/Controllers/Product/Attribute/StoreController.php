<?php

namespace Easy\Product\Http\Controllers\Product\Attribute;

use Easy\Product\Http\Requests\Attribute\Form\Validate;
use Illuminate\Http\RedirectResponse;

class StoreController extends BaseController
{
    /**
     * invoke
     *
     * @param Validate $request
     * @return RedirectResponse
     */
    public function __invoke(Validate $request): RedirectResponse
    {
        $inputs = $request->all();
        $this->attributeRepository->store($inputs);
        return redirect()->route('admin.product.index')->with('success', 'New Product created');
    }
}
