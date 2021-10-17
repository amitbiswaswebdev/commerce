<template>
    <BreezeValidationErrors class="mb-4" />
    <form @submit.prevent="submit" enctype='multipart/form-data'>
        <div class="block mt-4">
            <label class="flex items-center">
                <BreezeCheckbox name="remember" v-model:checked="form.status" />
                <span class="ml-2 text-sm text-gray-600">Is Enabled?</span>
            </label>
        </div>

        <div>
            <BreezeLabel for="title" value="Title" />
            <BreezeInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autofocus autocomplete="title" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="slug" value="Slug" />
            <BreezeInput id="slug" type="text" class="mt-1 block w-full" v-model="form.slug" required />
        </div>

        <div class="mt-4">
            <EasyFileUpload id="banner" v-model="form.banner" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="description" value="Description" />
            <EasyTextArea id="description" class="mt-1 block w-full" v-model="form.description"/>
        </div>

        <div>
            <BreezeLabel for="meta_title" value="Meta Title" />
            <BreezeInput id="meta_title" type="text" class="mt-1 block w-full" v-model="form.meta_title" required autofocus autocomplete="meta_title" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="meta_description" value="Meta Description" />
            <EasyTextArea id="meta_description" class="mt-1 block w-full" v-model="form.meta_description"/>
        </div>

        <div class="mt-4">
            <EasyFileUpload id="meta_image" v-model="form.meta_image" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Submit
            </BreezeButton>
        </div>
    </form>
</template>

<script>
import BreezeButton from '@/Components/Form/Button.vue'
import BreezeCheckbox from '@/Components/Form/Checkbox.vue'
import EasyTextArea from '@/Components/Form/TextArea.vue'
import EasyFileUpload from '@/Components/Form/FileUpload.vue'
import BreezeInput from '@/Components/Form/Input.vue'
import BreezeLabel from '@/Components/Form/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia'

export default {
    components: {
        BreezeButton,
        BreezeCheckbox,
        BreezeInput,
        EasyTextArea,
        EasyFileUpload,
        BreezeLabel,
        BreezeValidationErrors,
        Head,
        Link,
    },
    props: {
        canResetPassword: Boolean,
        status: String,
    },
    data() {
        return {
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
            if (this.form.id) {
                Inertia.post(this.route('admin.category.update', this.form.id), this.form, {
                    onSuccess: () => this.form.reset(),
                })
            } else{
                Inertia.post(this.route('admin.category.store'), this.form, {
                    onSuccess: () => this.form.reset(),
                })
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
