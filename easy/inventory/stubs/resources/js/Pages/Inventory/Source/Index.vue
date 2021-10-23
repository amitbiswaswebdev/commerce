<template>
    <Head title="Source" />
    <EasyAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Source List
            </h2>
        </template>

        <div class="p-12">
            <inventory-form />

            <easy-table
                :tableHead="tableHead"
                :tableData="$page.props.sources.data"
                :pagination="$page.props.sources.links">
                <template #cell-actions="{ row }">
                    <link-button @click="confirmDeletion(row.id)" type="button" class="mr-2">
                        <i class="mdi mdi-delete-outline" aria-hidden="true"></i>
                        Delete {{row.name}}
                    </link-button>
                    <Link :href="editItem(row.id)" class="ml-4"> <i class="mdi mdi-pencil" aria-hidden="true"></i> Edit {{row.name}} </Link>
                </template>
            </easy-table>

            <confirmation-modal :show="confirmingDeletion" @close="confirmingDeletion = false">
                <template #title>
                    Delete
                </template>

                <template #content>
                    Are you sure you want to delete this source? Once a source is deleted, all of its resources and data will be permanently deleted.
                </template>

                <template #footer>
                    <secondary-button @click="confirmingDeletion = false">
                        Cancel
                    </secondary-button>

                    <danger-button class="ml-2" @click="deleteItem" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        <i class="mdi mdi-delete-outline" aria-hidden="true"></i> Delete
                    </danger-button>
                </template>
            </confirmation-modal>

        </div>
    </EasyAuthenticatedLayout>
</template>

<script>
import EasyAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import EasyTable from '@/Components/Table.vue'
import InventoryForm from '@/Components/Inventory/Source/Form.vue'
import ConfirmationModal from '@/Components/ConfirmationModal.vue'
import DangerButton from '@/Components/Form/Buttons/DangerButton.vue'
import SecondaryButton from '@/Components/Form/Buttons/SecondaryButton.vue'
import LinkButton from '@/Components/Form/Buttons/LinkButton.vue'

export default {
    components: {
        ConfirmationModal,
        DangerButton,
        SecondaryButton,
        EasyAuthenticatedLayout,
        Head,
        Link,
        EasyTable,
        InventoryForm,
        LinkButton
    },
    data() {
            return {
                deleteItemId : null,
                confirmingDeletion : false,
                deleting: false,
                form: this.$inertia.form(),
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
                    label: 'Source',
                    column: 'title'
                },
                {
                    id:3,
                    align: 'text-center',
                    label: 'Status',
                    column: 'status'
                },
                {
                    id:4,
                    align: 'text-right',
                    label: 'Action',
                    column: 'actions'
                }
            ]
        }
    },
    methods: {
        confirmDeletion(id){
            this.deleteItemId = id
            this.confirmingDeletion = true
        },
        deleteItem(){
            this.form.delete(route('admin.source.delete', this.deleteItemId), {
                errorBag: 'deleteSource',
                onSuccess: () => {
                    this.confirmingDeletion = false
                    this.deleteItemId = null
                },
            })
        },
        editItem(id){
            return route('admin.source.edit', id) + '?page=' + this.getCurrentPageNumber();
        },
        getCurrentPageNumber(){
            let url = new URL(window.location.href)
            if (url.searchParams.get('page')) {
                return url.searchParams.get('page');
            }
            return 1;
        }
    },
}
</script>
