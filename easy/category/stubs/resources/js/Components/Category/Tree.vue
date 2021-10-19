<template>
    <draggable
    class="pl-4 border-l-2"
    tag="ul"
    :list="tasks"
    :group="{ name: 'g1' }"
    item-key="id"
    >
        <template #item="{ element }">
            <li>
                <div class="flex">
                    <i class="mdi mr-2" :class="(element.children.length) ? 'mdi-folder-outline' : ' mdi-file-outline'" aria-hidden="true"></i>
                    <span>{{ element.title }}</span>
                    <span class="flex-grow"></span>
                    <tree-action
                        :editRoute="editRoute"
                        :deleteRoute="deleteRoute"
                        :children="element.children.length"
                        :elementId="element.id" />
                </div>
                <nested-draggable :tasks="element.children" :editRoute="editRoute" :deleteRoute="deleteRoute"/>
            </li>
        </template>
    </draggable>

</template>
<script>

    import draggable from 'vuedraggable'
    import { Link } from '@inertiajs/inertia-vue3'
    import TreeAction from '@/Components/Category/TreeAction.vue'

    export default {
        name: "NestedDraggable",
        components: {
            Link,
            draggable,
            TreeAction
        },
        props: {
            tasks: {
                required: true,
                type: Array
            },
            editRoute: {
                required: true,
                type: String
            },
            deleteRoute: {
                required: true,
                type: String
            }
        },
        data() {
            return {
                confirmingCategoryDeletion : false,
                deleting: false,
            }
        },
         methods: {
            confirmCategoryDeletion() {
                this.confirmingCategoryDeletion = true
            },

            deleteCategory() {
                console.log('delete');
            },
        }
    };
</script>
