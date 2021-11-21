<template>
  <form @submit.prevent="submit" enctype="multipart/form-data">

    <easy-select />

    <easy-checkbox
      label="Show in frontend?"
      id="show_in_frontend"
      v-model:checked="form.show_in_frontend"
      :error="form.errors.show_in_frontend"
    />

    <easy-checkbox
      label="Use in catalog filter?"
      id="use_in_filter"
      v-model:checked="form.use_in_filter"
      :error="form.errors.use_in_filter"
    />

    <easy-checkbox
      label="Is required?"
      id="use_in_filter"
      v-model:checked="form.is_required"
      :error="form.errors.is_required"
    />

    <easy-input-field
      label="Code"
      id="code"
      type="text"
      v-model="form.code"
      autofocus
      :error="form.errors.level"
    />

    <easy-input-field
      label="Level"
      id="level"
      type="text"
      v-model="form.level"
      :error="form.errors.level"
    />

    <easy-input-field
      label="Default Value"
      id="default_value"
      type="text"
      v-model="form.default_value"
      :error="form.errors.default_value"
    />
  </form>
</template>

<script>
// import { computed, watch, reactive } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
// import _ from "lodash";
import EasyCheckbox from "@/Components/Form/Checkbox.vue";
import EasyInputField from "@/Components/Form/Input.vue";
import EasyTextArea from "@/Components/Form/TextArea.vue";
import EasyButton from "@/Components/Form/Buttons/Button.vue";
import EasySelect from "@/Components/Form/Select.vue";

export default {
  components: {
    EasyCheckbox,
    EasyInputField,
    EasyTextArea,
    EasyButton,
    EasySelect,
  },
  setup() {
    const defaultForm = {
      code: "",
      level: "",
      default_value: "",
      input: "text", // hidden
      validation_rules: ["required", "min", "max"],
      user_defined: true, // hidden
      model_value: null, // hidden
      show_in_frontend: true,
      use_in_filter: true,
      is_required: false,
    };
    const form = useForm(defaultForm);
    return { form };
  },
};
</script>
