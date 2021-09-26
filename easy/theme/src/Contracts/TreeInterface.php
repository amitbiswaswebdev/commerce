<?php

namespace Easy\Theme\Contracts;

interface TreeInterface
{
    public function getTree(array $arrayList,bool $isSortRequired = false) : array;
}
