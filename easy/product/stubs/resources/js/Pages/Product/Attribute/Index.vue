<template>
    <Head title="Product Attribute List" />
    <EasyAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Product Attribute List
            </h2>
        </template>

        <div class="p-12">
           Hello
        </div>
    </EasyAuthenticatedLayout>
</template>

<script>
    import EasyAuthenticatedLayout from '@/Layouts/Authenticated.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3'
    export default {
        components: {
            EasyAuthenticatedLayout,
            Head
        }
    }
</script>
