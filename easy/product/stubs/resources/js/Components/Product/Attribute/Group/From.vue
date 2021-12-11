<template>
  <form @submit.prevent="submit" enctype="multipart/form-data">
    <easy-input-field
      label="Code"
      id="code"
      type="text"
      v-model="form.code"
      :error="form.errors.code"
      :disabled="form.id !== null"
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
import EasyInputField from "@/Components/Form/Input.vue";
import EasyButton from "@/Components/Form/Buttons/Button.vue";

export default {
  components: {
    EasyInputField,
    EasyButton
  },
  props: {
    formData: {
      type: Object,
      required: false,
      default: {
        id: null,
        code: "",
        label: "",
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
