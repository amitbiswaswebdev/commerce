<template>
    <form @submit.prevent="submit" enctype='multipart/form-data'>
        <easy-checkbox label="TitIs Enabled?" id="status" v-model:checked="form.status" :error="form.errors.status" />
        <easy-input-field label="Title" id="title" type="text" v-model="form.title" autofocus :error="form.errors.title" />
        <div class="flex items-center justify-end my-4">
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
import EasyInputField from '@/Components/Form/Input.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
export default {
    components: {
        EasyButton,
        EasyCheckbox,
        EasyInputField,
        Head,
        Link,
    },
    data() {
        return {
            form: this.$inertia.form({
                id: null,
                status: true,
                title: '',
                page: 1
            })
        }
    },
    created() {
        let url = new URL(window.location.href)
        if (url.searchParams.get('page')) {
            this.form.page = url.searchParams.get('page');
        }
        if (this.$page.props.source) {
            this.form._method = 'put'
            this.form.id = this.$page.props.source.id
            this.form.status = (this.$page.props.source.status) ? true : false;
            this.form.title = this.$page.props.source.title
        }
    },
    methods: {
        submit() {
            if (this.form.id) {
                this.form.put(this.route('admin.source.update', this.form.id), {
                    errorBag: 'source',
                    onSuccess: () => this.form.reset(),
                });
            } else{
                this.form.post(this.route('admin.source.store'), {
                    errorBag: 'source',
                    onSuccess: () => this.form.reset(),
                });
            }
        }
    }
}
</script>
