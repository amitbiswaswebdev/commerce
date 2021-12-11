<template>
  <div class="flex">
    <div class="flex-auto"><attribute-group-form /></div>
    <attribute-to-group />
  </div>
</template>

<script>
import AttributeGroupForm from "@/Components/Product/Attribute/Group/From.vue";
import AttributeToGroup from "@/Components/Product/Attribute/Set/AttributeToGroup.vue";
export default {
  components: {
    AttributeGroupForm,
    AttributeToGroup
  },
  setup() {},
};
</script>
