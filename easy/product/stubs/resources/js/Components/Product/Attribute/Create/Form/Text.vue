<template>
  <form @submit.prevent="submit" enctype="multipart/form-data">
    <easy-checkbox
      label="Show in frontend?"
      id="show_in_frontend_features"
      v-model:checked="form.show_in_frontend_features"
      :error="form.errors.show_in_frontend_features"
    />

    <easy-checkbox
      label="Use in catalog filter?"
      id="use_in_filter"
      v-model:checked="form.use_in_filter"
      :error="form.errors.use_in_filter"
    />

    <easy-checkbox
      label="Is required?"
      id="required"
      v-model:checked="form.required"
      :error="form.errors.required"
    />

    <easy-input-field
      label="Code"
      id="code"
      type="text"
      v-model="form.code"
      :error="form.errors.code"
      :disabled="(form.id !== null)"
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

    <div class="flex items-center justify-end mt-4">
      <progress
        v-if="form.progress"
        :value="form.progress.percentage"
        max="100"
      >
        {{ form.progress.percentage }}%
      </progress>
      <EasyButton
        class="ml-4"
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
      >
        Submit
      </EasyButton>
    </div>
  </form>
</template>

<script>
// import { computed, watch, reactive } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
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
  props: {
    formData: {
      type: Object,
      required: false,
      default: {
        id: null,
        code: "",
        level: "",
        input: "",
        required: false,
        validations: null,
        user_defined: true,
        default_value: "",
        options: null,
        model_value: null,
        show_in_frontend_features: true,
        use_in_filter: 1,
        created_at: "",
        updated_at: "",
      },
    },
  },
  setup(props) {
    const form = useForm(props.formData);

    const submit = () => {
      if (props.formData.id) {
        form
          .transform((data) => ({
            ...data,
            created_at: null,
            updated_at: null,
          }))
          .put(route("admin.product.attribute.update", props.formData.id), {
            errorBag: "product_attribute",
            onSuccess: () => form.reset(),
          });
      } else {
        form.post(route("admin.product.attribute.store"), {
          errorBag: "product_attribute",
          onSuccess: () => form.reset(),
        });
      }
    };

    return { form, submit };
  },
};
</script>
