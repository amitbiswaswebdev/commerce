# commerce
Laravel package for e-commerce

# To register
composer config repositories.inventory '{"type": "path", "url": "./package/easy/inventory"}' --file composer.json
composer require

1. theme
2. customer
3. admin
4. category

# To publish Content (follow the sequence)
1. php artisan vendor:publish --tag=theme --force
2. php artisan vendor:publish --tag=customer --force
3. php artisan vendor:publish --tag=admin --force
4. php artisan vendor:publish --tag=category --force




<!-- <tableLayout
                :tableHead="tableheadData"
                :tableData="$page.props.categories.data"
                :pagination="$page.props.categories.links"
                :selectable="true"
                @selected="selectedValues = $event">
                <template #cell-action="{ row }">
                    Edit / Delete
                </template>
            </tableLayout> -->
