<template>
    <Head title="Category" />
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Category List
            </h2>
        </template>

        <div class="container mx-auto my-12 flex">
            <div class="flex-none w-64">
                <tree-view
                    v-if="$page.props.categories.length"
                    :tasks="$page.props.categories"
                    editRoute="admin.category.edit"
                />
            </div>
            <div class="flex-grow">
                <category-form />
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import TreeView from '@/Components/Category/Tree.vue'
import CategoryForm from '@/Components/Category/Form.vue'
import { Head } from '@inertiajs/inertia-vue3'

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        TreeView,
        CategoryForm
    },
}
</script>
