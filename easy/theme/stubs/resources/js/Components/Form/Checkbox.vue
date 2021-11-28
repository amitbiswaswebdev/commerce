<template>
  <div class="block mt-4">
    <label class="flex items-center">
      <input
        :id="id"
        type="checkbox"
        :value="value"
        v-model="proxyChecked"
        class="
          rounded
          border-gray-300
          text-indigo-600
          shadow-sm
          focus:border-indigo-300
          focus:ring
          focus:ring-indigo-200
          focus:ring-opacity-50
        "
      />
      <span class="ml-2 text-sm text-gray-600">{{ label }}</span>
    </label>
    <easy-input-error v-if="error" :message="error" />
  </div>
</template>

<script>
import { defineComponent } from "vue";
import EasyInputError from "@/Components/Form/InputError.vue";
export default defineComponent({
  emits: ["update:checked"],
  components: {
    EasyInputError,
  },
  props: {
    id: {
      type: String,
      required: true,
    },
    label: {
      type: String,
      required: true,
    },
    checked: {
      type: [Array, Boolean, Number],
      default: false,
    },
    value: {
      default: null,
    },
    error: {
      type: String,
      required: false,
      default: null,
    },
  },

  computed: {
    proxyChecked: {
      get() {
        return this.checked ? true : false;
      },

      set(val) {
        this.$emit("update:checked", val);
      },
    },
  },
});
</script>
