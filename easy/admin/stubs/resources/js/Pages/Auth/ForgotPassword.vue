<template>
    <Head title="Forgot Password" />

    <div class="mb-4 text-sm text-gray-600">
        Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
    </div>

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>

    <EasyValidationErrors class="mb-4" />

    <form @submit.prevent="submit">
        <div>
            <EasyLabel for="email" value="Email" />
            <EasyInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <EasyButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Email Password Reset Link
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

    props: {
        status: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                email: ''
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('admin.password.email'))
        }
    }
}
</script>
