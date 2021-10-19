<template>
    <link-button v-if="children === 0" @click="confirmDeletion" type="button" class="mr-2">
        <i class="mdi mdi-delete-outline" aria-hidden="true"></i>
    </link-button>

    <confirmation-modal :show="confirmingDeletion" @close="confirmingDeletion = false">
        <template #title>
            Delete
        </template>

        <template #content>
            Are you sure you want to delete this item? Once a item is deleted, all of its resources and data will be permanently deleted.
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

    <Link :href="route(editRoute, elementId)">
        <i class="mdi mdi-pencil" aria-hidden="true"></i>
    </Link>
</template>

<script>

    import { Link } from '@inertiajs/inertia-vue3'
    import ConfirmationModal from '@/Components/ConfirmationModal.vue'
    import DangerButton from '@/Components/Form/Buttons/DangerButton.vue'
    import SecondaryButton from '@/Components/Form/Buttons/SecondaryButton.vue'
    import LinkButton from '@/Components/Form/Buttons/LinkButton.vue'
    export default {
        name: "TreeAction",
        props: {
            editRoute: {
                required: true,
                type: String
            },
            deleteRoute: {
                required: true,
                type: String
            },
            elementId: {
                required: true,
                type: Number
            },
            children : {
                required: true,
                type: Number
            }
        },
        components: {
            Link,
            ConfirmationModal,
            DangerButton,
            SecondaryButton,
            LinkButton
        },
        data() {
            return {
                confirmingDeletion : false,
                deleting: false,
                form: this.$inertia.form()
            }
        },
         methods: {
            confirmDeletion() {
                this.confirmingDeletion = true
            },

            deleteItem() {
                this.form.delete(route(this.deleteRoute, this.elementId), {
                    errorBag: 'deleteCategory'
                });
            },
        }
    };
</script>
