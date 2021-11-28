<?php

namespace Easy\Inventory\Service;

use Illuminate\Pagination\LengthAwarePaginator;
use Easy\Inventory\Models\Source as SourceModel;
use Easy\Inventory\Contracts\SourceRepositoryInterface;

class SourceRepository implements SourceRepositoryInterface
{
    /**
     * sourceModel
     */
    protected SourceModel $sourceModel;

    /**
     * construct
     *
     * @param SourceModel $sourceModel
     */
    public function __construct(SourceModel $sourceModel)
    {
        $this->sourceModel = $sourceModel;
    }

    /**
     * @inheritDoc
     */
    public function getList(array $select = self::SELECTABLE, int $itemPerPage = 10, string $fetchStatus = 'all', string $orderBy = 'id', bool $isASC = true) : LengthAwarePaginator {
        $direction = ($isASC) ? 'ASC' : 'DESC';
        $status = match ($fetchStatus) {
            'active' => 1,
            'inactive' => 0,
            default => null
        };
        return $this->sourceModel::orderBy($orderBy, $direction)
        ->select($select)
        ->when($status, function ($query, $status) {
            return $query->where('status',$status);
        })
        ->paginate($itemPerPage);
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id, bool $onlyActive = false) : SourceModel {
        // $source = $this->sourceModel::findOrFail($id);
        return $this->sourceModel::findOrFail($id);
    }
}
