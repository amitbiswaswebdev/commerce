<?php

namespace Easy\Product\Http\Controllers\Product\Attribute;

use Inertia\Response;
use Inertia\Inertia;

class CreateController extends BaseController
{
    /**
     * invoke
     *
     * @param string $type
     * @return Response
     */
    public function __invoke(string $type): Response
    {

        if (in_array((string) $type,self::TYPE)) {
            $templatePath = 'Product/Attribute/Form/' . str_replace('-', '', ucwords($type, '-'));
            return Inertia::render($templatePath,['attribute' => null]);
        } else {
            return abort(404);
        }
    }
}
