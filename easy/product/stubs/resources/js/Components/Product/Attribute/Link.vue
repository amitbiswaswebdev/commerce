<template>
  <EasyDropdown align="left" width="48" class="mb-4">
    <template #trigger>
      <EasyButton type="bytton">
        Creat a New <i class="mdi mdi-menu-down" aria-hidden="true"></i>
      </EasyButton>
    </template>
    <template #content>
      <template v-for="(type, index) in attributeType" :key="index">
        <EasyDropdownLink :href="route('admin.product.attribute.create',type.type)">
          {{ type.lable }}
        </EasyDropdownLink>
      </template>
    </template>
  </EasyDropdown>
</template>

<script>
import EasyDropdown from "@/Components/Dropdown.vue";
import EasyDropdownLink from "@/Components/DropdownLink.vue";
import EasyButton from "@/Components/Form/Buttons/Button.vue";

export default {
  components: {
    EasyDropdown,
    EasyDropdownLink,
    EasyButton,
  },
  setup() {
    const attributeType = [
      {
        lable: "Text",
        type: "text"
      },
      {
        lable: "Number",
        type: "number"
      },
      {
        lable: "Date",
        type: "date"
      },
      {
        lable: "Radio",
        type: "radio"
      },
      {
        lable: "Check Box",
        type: "checkbox"
      },
      {
        lable: "Text Select",
        type: "text-select"
      },
      {
        lable: "Color Select",
        type: "color-select"
      },
      {
        lable: "Visual Select",
        type: "visual-select"
      },
      {
        lable: "Multi Select",
        type: "multi-select"
      },
      {
        lable: "File",
        type: "file"
      },
      {
        lable: "Image",
        type: "image"
      },
    ];

    return { attributeType };
  },
};
</script>
