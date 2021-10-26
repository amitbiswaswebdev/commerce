<?php

namespace Easy\Theme\Service;

use Easy\Theme\Contracts\TreeInterface;

/**
 * Tree
 */
class Tree implements TreeInterface
{
    /**
     * @inheritDoc
     */
    public function getTree(array $arrayList,bool $isSortRequired = false) : array
    {
        $new = [];
        if ($isSortRequired && sizeof($arrayList) > 1) {
            array_multisort(array_column($arrayList, 'sort_order'), SORT_ASC, $arrayList);
        }
        if (sizeof($arrayList) > 0) {
            foreach ($arrayList as $arrayItem){
                $arrayItem['children'] = [];
                $new[$arrayItem['parent_id']][] = $arrayItem;
            }
            return $this->createTree($new, $new[0]);
        }else {
            return [];
        }
    }

    /**
     * @param $arrayList
     * @param $parents
     * @return array
     */
    private function createTree(&$arrayList, $parents): array
    {
        $tree = [];
        foreach ($parents as $parent){
            if( isset( $arrayList[ $parent[ 'id' ] ] ) )
            {
                $parent['children'] = $this->createTree($arrayList, $arrayList[$parent['id']]);
            }
            $tree[] = $parent;
        }
        return $tree;
    }
}
