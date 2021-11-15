<?php

namespace Easy\Inventory\Http\Controllers\Source;

use App\Http\Controllers\Controller;
use Easy\Inventory\Models\Source as SourceModel;
use Easy\Inventory\Contracts\SourceRepositoryInterface;

/**
 * Category
 */
class BaseController extends Controller
{
    protected SourceModel $sourceModel;
    protected SourceRepositoryInterface $sourceRepository;

    /**
     * construct
     *
     * @param SourceModel $sourceModel
     * @param SourceRepositoryInterface $sourceRepository
     */
    public function __construct(
        SourceModel $sourceModel,
        SourceRepositoryInterface $sourceRepository
    ) {
        $this->sourceModel = $sourceModel;
        $this->sourceRepository = $sourceRepository;
    }
}
