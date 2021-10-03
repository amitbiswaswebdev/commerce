<?php

namespace Easy\Theme\Contracts;

interface TreeInterface
{
    /**
     * getTree
     *
     * @param array $arrayList
     * @param bool $isSortRequired
     * @return array
     */
    public function getTree(array $arrayList,bool $isSortRequired = false) : array;
}
