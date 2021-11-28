<?php

namespace Easy\Product\Http\Controllers\Product\Attribute;

use Easy\Product\Http\Requests\Attribute\Form\Validate;
use Illuminate\Http\RedirectResponse;

class UpdateController extends BaseController
{
    /**
     * invoke
     *
     * @param Validate $request
     * @param int $id
     * @return RedirectResponse
     */
    public function __invoke(Validate $request,int $id): RedirectResponse
    {
        $inputs = $request->all();
        $this->attributeRepository->update($inputs, $id);
        return redirect()->route('admin.product.attribute.index')->with('success', 'Product Attribute Updated.');
    }
}
