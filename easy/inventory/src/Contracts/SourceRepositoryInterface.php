<?php

namespace Easy\Inventory\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;
use Easy\Inventory\Models\Source as SourceModel;

interface SourceRepositoryInterface
{
    /**
     * Source table selectable fields
     */
    const SELECTABLE = [
        'id',
        'status',
        'title',
        'created_at',
        'updated_at'
    ];

    /**
     * getList
     *
     * @param array $select
     * @param int $itemPerPage
     * @param string $fetchStatus
     * @param string $orderBy
     * @param bool $isASC
     * @return LengthAwarePaginator
     */
    public function getList(array $select = self::SELECTABLE, int $itemPerPage = 10, string $fetchStatus = 'all', string $orderBy = 'id', bool $isASC = true) : LengthAwarePaginator;

    /**
     * getById
     *
     * @param int $id
     * @param bool $onlyActive
     * @return SourceModel
     */
    public function getById(int $id, bool $onlyActive = false) : SourceModel;
}
