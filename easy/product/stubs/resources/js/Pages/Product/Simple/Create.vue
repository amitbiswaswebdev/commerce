<template>
    <Head title="Create a new product" />
    <EasyAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create a new product
            </h2>
        </template>
        <div class="p-12">
            <product-form/>
        </div>
    </EasyAuthenticatedLayout>
</template>

<script>
    import EasyAuthenticatedLayout from '@/Layouts/Authenticated.vue'
    import { Head } from '@inertiajs/inertia-vue3'
    import ProductForm from '@/Components/Product/Simple/Form.vue'
    export default {
        components: {
            EasyAuthenticatedLayout,
            Head,
            ProductForm
        }
    }
</script>
