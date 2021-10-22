<template>
    <Head title="Category" />
    <EasyAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Source List
            </h2>
        </template>

        Hello
    </EasyAuthenticatedLayout>
</template>

<script>
import EasyAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3'
export default {
    components: {
        EasyAuthenticatedLayout,
        Head,
    }
}
</script>
