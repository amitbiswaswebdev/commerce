<template>
    <Head title="Product" />
    <EasyAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Product List
            </h2>
        </template>

        <div class="p-12">
            <create-product-link />
            <easy-table
                :tableHead="tableHead"
                :tableData="$page.props.products.data"
                :pagination="$page.props.products.links">

                <template #cell-status="{ row }">
                    <span v-if="row.status">Active</span>
                    <span v-else>Inactive</span>
                </template>

                <template #cell-base_price="{ row }">
                    <template v-if="row.prices.length"> {{row.prices[0].base_price}} </template>
                    <template v-else>N/A</template>
                </template>

                <template #cell-special_price="{ row }">
                    <template v-if="row.prices.length"> {{row.prices[0].base_price}} </template>
                    <template v-else>N/A</template>
                </template>

                <template #cell-actions="{ row }">
                    <Link href="#" class="ml-4"> <i class="mdi mdi-pencil" aria-hidden="true"></i> Edit {{row.id}} </Link>
                </template>

            </easy-table>
        </div>
    </EasyAuthenticatedLayout>
</template>

<script>
    import EasyAuthenticatedLayout from '@/Layouts/Authenticated.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import EasyTable from '@/Components/Table.vue'
    import CreateProductLink from '@/Components/Product/CreateProductLink.vue'
    export default {
        components: {
            EasyAuthenticatedLayout,
            Head,
            Link,
            EasyTable,
            CreateProductLink
        },
        data() {
            return {
                tableHead: [
                    {
                        id:1,
                        align: 'text-left',
                        label: 'ID',
                        column: 'id'
                    },
                    {
                        id:2,
                        align: 'text-center',
                        label: 'Status',
                        column: 'status'
                    },
                    {
                        id:3,
                        align: 'text-center',
                        label: 'SKU',
                        column: 'sku'
                    },
                    {
                        id:4,
                        align: 'text-center',
                        label: 'Title',
                        column: 'title'
                    },
                    {
                        id:5,
                        align: 'text-center',
                        label: 'Base Price',
                        column: 'base_price'
                    },
                    {
                        id:6,
                        align: 'text-center',
                        label: 'Special Price',
                        column: 'special_price'
                    },
                    {
                        id:7,
                        align: 'text-right',
                        label: 'Action',
                        column: 'actions'
                    }
                ]
            }
        },
    }
</script>
