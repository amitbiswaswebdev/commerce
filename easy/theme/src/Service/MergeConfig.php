<?php

namespace Easy\Theme\Service;

use Easy\Theme\Contracts\MergeConfigInterface;

class MergeConfig implements MergeConfigInterface
{
    public function multiLevelArrayMerge($toMerge, $original)
    {
        $auth = [];
        foreach ($original as $key => $value) {
            if (isset($toMerge[$key]) && is_array($value)) {
                $auth[$key] = array_merge($value, $toMerge[$key]);
            }
            elseif (isset($toMerge[$key])) {
                $auth[$key] = $toMerge[$key];
            }
            else {
                $auth[$key] = $value;
            }
        }

        return $auth;
    }
}
