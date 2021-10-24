<template>
    <form @submit.prevent="submit" enctype='multipart/form-data'>

        <easy-checkbox
            label="Is Enabled?"
            id="status"
            v-model:checked="form.status"
            :error="form.errors.status"
        />

        <easy-input-field
            label="Title"
            id="title"
            type="text"
            v-model="form.title"
            autofocus
            :error="form.errors.title"
        />

        <easy-input-field
            label="SKU"
            id="sku"
            type="text"
            v-model="form.sku"
            :error="form.errors.sku"
        />

        <easy-text-area
            label="Small Description"
            id="small_description"
            v-model="form.small_description"
            :error="form.errors.small_description"
        />

        <easy-text-area
            label="Description"
            id="description"
            v-model="form.description"
            :error="form.errors.description"
        />

        <easy-checkbox
            label="Maintain stock?"
            id="maintain_stock"
            v-model:checked="form.maintain_stock"
            :error="form.errors.maintain_stock"
        />

        <easy-input-field
            label="Slug"
            id="slug"
            type="text"
            v-model="form.slug"
            :error="form.errors.slug"
            @on-focus-input="isManuallyChanged.slug.onfocus = $event"
            @on-blur-input="isManuallyChanged.slug.onblur = $event"
        />

        <easy-input-field
            label="Meta title"
            id="meta_title"
            type="text"
            v-model="form.meta_title"
            :error="form.errors.meta_title"
            @on-focus-input="isManuallyChanged.meta_title.onfocus = $event"
            @on-blur-input="isManuallyChanged.meta_title.onblur = $event"
        />

        <easy-text-area
            label="Meta Description"
            id="meta_description"
            v-model="form.meta_description"
            :error="form.errors.meta_description"
        />
        <!-- <easy-file-upload label="Banner" id="banner" v-model="form.banner" /> -->

        <div class="flex items-center justify-end mt-4">
            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                {{ form.progress.percentage }}%
            </progress>
            <EasyButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Submit
            </EasyButton>
        </div>
    </form>
</template>

<script>
import { computed, watch, reactive } from 'vue'
import { usePage, useForm } from '@inertiajs/inertia-vue3'
import _ from "lodash";
import EasyCheckbox from '@/Components/Form/Checkbox.vue'
import EasyInputField from '@/Components/Form/Input.vue'
import EasyTextArea from '@/Components/Form/TextArea.vue'
import EasyButton from '@/Components/Form/Buttons/Button.vue'

export default {
    components: {
        EasyCheckbox,
        EasyInputField,
        EasyTextArea,
        EasyButton
    },
    setup() {

        const defaultForm = {
            status : true,
            sku : '',
            title:'',
            small_description:'',
            description:'',
            maintain_stock:true,
            slug:'',
            meta_title:'',
            meta_description:'',
            meta_image:''
        }

        const isManuallyChanged = reactive({
            slug: {
                onfocus : '',
                onblur : ''
            },
            meta_title:  {
                onfocus : '',
                onblur : ''
            }
        })

        const form = useForm(defaultForm)

        const selectedProductType = computed(() => usePage().props.value.type)

        watch(() => form.slug, (currentValue) => {
            form.slug = _.replace(currentValue.trim().toLowerCase(), ' ', '-');
        })

        watch(() => form.title, (currentValue) => {
            if ( isManuallyChanged.meta_title.onfocus === '' || isManuallyChanged.meta_title.onblur === '' ) {
                form.meta_title = currentValue.trim()
            }
            if ( isManuallyChanged.slug.onfocus === '' || isManuallyChanged.slug.onblur === '' ) {
                form.slug = currentValue.trim()
            }
        })

        const submit = () => {
            form.post(route('admin.product.simple.store'), {
                errorBag: 'simple_product',
                onSuccess: () => form.reset(),
            })
        }

        return { form, isManuallyChanged, submit }
    }
}
</script>
