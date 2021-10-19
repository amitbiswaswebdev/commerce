<template>
    <form @submit.prevent="submit" enctype='multipart/form-data'>
        <easy-checkbox label="TitIs Enabled?le" id="status" v-model:checked="form.status" :error="form.errors.slug" />
        <easy-input-field label="Title" id="title" type="text" v-model="form.title" autofocus :error="form.errors.title" />
        <easy-input-field label="Slug" id="slug" type="text" v-model="form.slug" :error="form.errors.slug" />
        <easy-file-upload label="Banner" id="banner" v-model="form.banner" />
        <easy-text-area label="Description" id="description" v-model="form.description" :error="form.errors.description"/>
        <easy-input-field label="Meta Title" id="meta_title" type="text" v-model="form.meta_title" :error="form.errors.meta_title" />
        <easy-text-area label="Meta Description" id="meta_description" v-model="form.meta_description" :error="form.errors.meta_description"/>
        <easy-file-upload label="Meta Image" id="meta_image" v-model="form.meta_image"/>
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
import EasyButton from '@/Components/Form/Buttons/Button.vue'
import EasyCheckbox from '@/Components/Form/Checkbox.vue'
import EasyTextArea from '@/Components/Form/TextArea.vue'
import EasyFileUpload from '@/Components/Form/FileUpload.vue'
import EasyInputField from '@/Components/Form/Input.vue'
import EasyLabel from '@/Components/Form/Label.vue'
import EasyValidationErrors from '@/Components/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia'

export default {
    components: {
        EasyButton,
        EasyCheckbox,
        EasyInputField,
        EasyTextArea,
        EasyFileUpload,
        EasyLabel,
        EasyValidationErrors,
        Head,
        Link,
    },
    props: {
        canResetPassword: Boolean,
        status: String,
    },
    data() {
        return {
            defaultFileObj : {
                id : null,
                initial_sort_index : null,
                url : '',
                name : '',
                size : '',
                file : null,
                show: true
            },
            form: this.$inertia.form({
                id: null,
                status: true,
                title: '',
                slug: '',
                description: '',
                banner: [],
                meta_title: '',
                meta_description: '',
                meta_image: [],
                parent_id: '',
            })
        }
    },
    created() {
        if (this.$page.props.category) {
            this.form._method = 'put'
            this.form.id = this.$page.props.category.id
            this.form.status = (this.$page.props.category.status) ? true : false;
            this.form.title = this.$page.props.category.title
            this.form.slug = this.$page.props.category.slug
            this.form.description = this.$page.props.category.description
            this.form.meta_title = this.$page.props.category.meta_title
            this.form.meta_description = this.$page.props.category.meta_description
            this.form.parent_id = this.$page.props.category.parent_id
            this.form.banner = this.getPreviewImage(
                this.$page.props.category.id,
                this.$page.props.category.banner,
                this.$page.props.category.title
            )
            this.form.meta_image = this.getPreviewImage(
                this.$page.props.category.id,
                this.$page.props.category.meta_image,
                this.$page.props.category.meta_title
            )
        }
    },
    methods: {
        submit() {
            if (this.form.banner.length === 0) {
                this.form.banner.push(this.defaultFileObj)
            }
            if (this.form.meta_image.length === 0) {
                this.form.meta_image.push(this.defaultFileObj)
            }
            if (this.form.id) {
                this.form.put(this.route('admin.category.update', this.form.id), {
                    errorBag: 'category',
                    onSuccess: () => this.form.reset(),
                });
            } else{
                this.form.post(this.route('admin.category.store'), {
                    errorBag: 'category',
                    onSuccess: () => this.form.reset(),
                });
            }
        },
        getPreviewImage(id, url, name, size = 102400){
            return [{
                id : id,
                initial_sort_index : null,
                url : url,
                name : name,
                size : size,
                file : null,
                show: true
            }];
        }
    }
}
</script>
