<?php

namespace Easy\Theme\Contracts;

interface MergeConfigInterface
{
    /**
     * @param $toMerge
     * @param $original
     * @return mixed
     */
    public function multiLevelArrayMerge($toMerge, $original);
}
