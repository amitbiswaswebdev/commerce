<template>
  <Head title="Product Attribute List" />
  <EasyAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Product Attribute List
      </h2>
    </template>

    <div class="p-12">
      <attribute-create-link />
      <attribute-list />
    </div>
  </EasyAuthenticatedLayout>
</template>

<script>
import EasyAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
import AttributeList from "@/Components/Product/Attribute/List.vue";
import AttributeCreateLink from "@/Components/Product/Attribute/Link.vue";
export default {
  components: {
    EasyAuthenticatedLayout,
    Head,
    AttributeList,
    AttributeCreateLink,
  },
};
</script>
