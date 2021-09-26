<?php

namespace Easy\Theme\Contracts;

interface MergeConfigInterface
{
    public function multiLevelArrayMerge($toMerge, $original);
}
