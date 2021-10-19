<template>
    <Head title="Confirm Password" />

    <div class="mb-4 text-sm text-gray-600">
        This is a secure area of the application. Please confirm your password before continuing.
    </div>

    <EasyValidationErrors class="mb-4" />

    <form @submit.prevent="submit">
        <div>
            <EasyLabel for="password" value="Password" />
            <EasyInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" autofocus />
        </div>

        <div class="flex justify-end mt-4">
            <EasyButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Confirm
            </EasyButton>
        </div>
    </form>
</template>

<script>
import EasyButton from '@/Components/Form/Buttons/Button.vue'
import EasyGuestLayout from '@/Layouts/Guest.vue'
import EasyInput from '@/Components/Form/Input.vue'
import EasyLabel from '@/Components/Form/Label.vue'
import EasyValidationErrors from '@/Components/ValidationErrors.vue'
import { Head } from '@inertiajs/inertia-vue3';

export default {
    layout: EasyGuestLayout,

    components: {
        EasyButton,
        EasyInput,
        EasyLabel,
        EasyValidationErrors,
        Head,
    },

    data() {
        return {
            form: this.$inertia.form({
                password: '',
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('admin.password.confirm'), {
                onFinish: () => this.form.reset(),
            })
        }
    }
}
</script>
