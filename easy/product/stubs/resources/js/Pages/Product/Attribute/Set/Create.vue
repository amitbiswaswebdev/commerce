<template>
  <Head title="Product Attribute List" />
  <EasyAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Product Attribute Set List
      </h2>
    </template>

    <div class="p-12">
        <attribute-set-form />
    </div>
  </EasyAuthenticatedLayout>
</template>

<script>
import EasyAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import AttributeSetForm from "@/Components/Product/Attribute/Set/Form.vue";

export default {
  components: {
    EasyAuthenticatedLayout,
    Head,
    AttributeSetForm,
    Link,
  },
};
</script>
