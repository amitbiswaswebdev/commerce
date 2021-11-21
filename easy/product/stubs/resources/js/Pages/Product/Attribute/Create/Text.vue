<template>
  <Head title="Product Text Type Attribute " />
  <EasyAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Product Attribute List
      </h2>
    </template>
    <div class="p-12">
        <TestAttributeForm />
    </div>
  </EasyAuthenticatedLayout>
</template>

<script>
import { Head } from "@inertiajs/inertia-vue3";
import EasyAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import TestAttributeForm from '@/Components/Product/Attribute/Create/Form/Text.vue';
export default {
  components: {
    EasyAuthenticatedLayout,
    Head,
    TestAttributeForm
  },
};
</script>
