<?php

namespace Easy\Product\Http\Controllers\Product\Attribute;

use Inertia\Response;
use Inertia\Inertia;

class EditController extends BaseController
{
    /**
     * invoke
     *
     * @param string $type
     * @param int $id
     * @return Response
     */
    public function __invoke(string $type, int $id): Response
    {
        if (in_array((string) $type,self::TYPE)) {
            $attribute = $this->attributeRepository->getById($id);
            $templatePath = 'Product/Attribute/Form/' . str_replace('-', '', ucwords($type, '-'));
            return Inertia::render($templatePath,['attribute' => $attribute]);
        } else {
            return abort(404);
        }
    }
}
