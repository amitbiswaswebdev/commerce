<template>
    <Head title="Category" />
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Category List
            </h2>
        </template>

        <div class="container mx-auto my-12">
            <tableLayout
                :tableHead="tableheadData"
                :tableData="$page.props.categories.data"
                :pagination="$page.props.categories.links"
                :selectable="true"
                @selected="selectedValues = $event">
                <template #cell-action="{ row }">
                    Edit / Delete
                </template>
            </tableLayout>
        </div>

    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import TableLayout from '@/Components/Table.vue'
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        TableLayout,
    },
    data() {
        return {
            selectedValues: [],
            tableheadData : [
                {
                    column: 'title',
                    label: 'Title',
                    align: 'text-left'
                },
                {
                    column: 'slug',
                    label: 'Slug',
                    align: 'text-center'
                },
                {
                    column: 'action',
                    label: 'Action',
                    align: 'text-right'
                }
            ],
            tableColumnData : [
                {
                    name: 'John Covv',
                    email: 'contato@johncovv.com'
                },
                {
                    name: 'Michael Jackson',
                    email: 'm_jackson@mail.com'
                },
                {
                    name: 'Julia',
                    email: 'julia@mail.com'
                },
                {
                    name: 'Martin Madrazo',
                    email: 'martin.madrazo@mail.com'
                },
            ]
        }
    },
}
</script>
