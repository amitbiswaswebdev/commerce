<?php

namespace Easy\Inventory\Http\Controllers\Source;

use App\Http\Controllers\Controller;
use Easy\Inventory\Models\Source as SourceModel;

/**
 * Category
 */
class BaseController extends Controller
{
    protected SourceModel $sourceModel;

    /**
     * construct
     *
     * @param sourceModel $sourceModel
     */
    public function __construct(
        SourceModel $sourceModel
    ) {
        $this->sourceModel = $sourceModel;
    }
}
