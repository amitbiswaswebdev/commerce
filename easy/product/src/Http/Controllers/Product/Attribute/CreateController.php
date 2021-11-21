<?php

namespace Easy\Product\Http\Controllers\Product\Attribute;

use Inertia\Response;
use Inertia\Inertia;

class CreateController extends BaseController
{
    /**
     * @return Response
     */
    public function __invoke(string $type): Response
    {

        if (in_array((string) $type,self::TYPE)) {
            $templatePath = 'Product/Attribute/Create/' . str_replace('-', '', ucwords($type, '-'));
            return Inertia::render($templatePath);
        } else {
            return abort(404);
        }
    }
}
