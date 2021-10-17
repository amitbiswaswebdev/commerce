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
                    <Link v-if="element.children.length === 0" :href="route(deleteRoute, element.id)" class="mr-2" method="delete" as="button">
                        <i class="mdi mdi-delete-outline" aria-hidden="true"></i>
                    </Link>
                    <Link :href="route(editRoute, element.id)">
                        <i class="mdi mdi-pencil" aria-hidden="true"></i>
                    </Link>
                </div>
                <nested-draggable :tasks="element.children" :editRoute="editRoute" :deleteRoute="deleteRoute"/>
            </li>
        </template>
    </draggable>
</template>
<script>
    import draggable from 'vuedraggable'
    import { Link } from '@inertiajs/inertia-vue3'
    export default {
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
        components: {
            Link,
            draggable
        },
        name: "NestedDraggable"
    };
</script>
