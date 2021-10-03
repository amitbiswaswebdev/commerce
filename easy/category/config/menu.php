<?php

return [
    [
        'id' => 2,
        'sort_order' => 20,
        'name' => 'Catalog',
        'route' => '#',
        'parent_id' => 0
    ],
    [
        'id' => 3,
        'sort_order' => 10,
        'name' => 'Category',
        'route' => 'admin.category.index',
        'parent_id' => 2
    ],
];
