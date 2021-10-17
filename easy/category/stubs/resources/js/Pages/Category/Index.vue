<template>
    <Head title="Category" />
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Category List
            </h2>
        </template>

        <div class="container mx-auto my-12 flex">
            <div class="flex-none w-64 px-2">
                <EasyButton
                    type="button"
                    class="w-full mb-2"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click="reorder()"
                    >
                    Re-order
                </EasyButton>
                <tree-view
                    v-if="treeView.length"
                    :tasks="treeView"
                    editRoute="admin.category.edit"
                    deleteRoute="admin.category.delete"
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
import { Inertia } from '@inertiajs/inertia'
import EasyButton from '@/Components/Form/Button.vue'
export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        TreeView,
        CategoryForm,
        EasyButton
    },
    data() {
        return {
            form: this.$inertia.form({
                treeList : []
            })
        }
    },
    computed: {
        treeView() {
            return this.$page.props.categories
        }
    },
    watch: {
        treeView: {
            handler(val) {
                this.form.treeList = val
            },
            deep: true
        },
    },
    methods: {
        reorder(){
            Inertia.post(this.route('admin.category.reorder'), this.form, {
                onSuccess: () => {
                    console.log('Successful');
                },
            })
        }
    },
}
</script>
