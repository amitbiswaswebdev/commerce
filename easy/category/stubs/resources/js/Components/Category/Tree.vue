<template>
    <draggable
    class="pl-4 border-l-2"
    tag="ul"
    :list="tasks"
    :group="{ name: 'g1' }"
    item-key="name"
    >
        <template #item="{ element }">
            <li>
                <div class="flex">
                    <i class="mdi mr-2" :class="(element.tasks.length) ? 'mdi-folder-outline' : ' mdi-file-outline'" aria-hidden="true"></i>
                    <span>{{ element.name }}</span>
                    <span class="flex-grow"></span>
                    <i class="mdi mdi-pencil mr-2" aria-hidden="true"></i>
                    <i class="mdi mdi-delete-outline mr-2" aria-hidden="true"></i>
                </div>
                <nested-draggable :tasks="element.tasks" />
            </li>
        </template>
    </draggable>
</template>
<script>
    import draggable from 'vuedraggable'
    export default {
        props: {
            tasks: {
                required: true,
                type: Array
            }
        },
        components: {
            draggable
        },
        name: "NestedDraggable"
    };
</script>
