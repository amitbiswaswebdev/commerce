<template>
  <Head title="Product Text Type Attribute " />
  <EasyAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <span v-if="attribute">Edit</span>
        <span v-else>Create</span>
      </h2>
    </template>
    <div class="p-12">
      <TextAttributeForm v-if="attribute" :formData="attribute" />
      <TextAttributeForm v-else />
    </div>
  </EasyAuthenticatedLayout>
</template>

<script>
import { computed } from "vue";
import { Head, usePage } from "@inertiajs/inertia-vue3";
import EasyAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import TextAttributeForm from "@/Components/Product/Attribute/Create/Form/Text.vue";
export default {
  components: {
    EasyAuthenticatedLayout,
    Head,
    TextAttributeForm,
  },
  setup() {
    const attribute = computed(() => usePage().props.value.attribute);
    return { attribute };
  },
};
</script>
