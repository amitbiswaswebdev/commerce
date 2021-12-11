<template>
  <Head title="Product Attribute List" />
  <EasyAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Product Attribute Set List
      </h2>
    </template>

    <div class="p-12">
        <Link :href="route('admin.product.attribute.set.create')">
            Create New Attribute Set
        </Link>
      <!-- <attribute-list /> -->
    </div>
  </EasyAuthenticatedLayout>
</template>

<script>
import EasyAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import AttributeList from "@/Components/Product/Attribute/List.vue";
export default {
  components: {
    EasyAuthenticatedLayout,
    Head,
    AttributeList,
    Link,
  },
};
</script>
