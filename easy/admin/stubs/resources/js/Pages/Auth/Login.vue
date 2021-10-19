<template>
    <Head title="Log in" />

    <EasyValidationErrors class="mb-4" />

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>

    <form @submit.prevent="submit">
        <div>
            <EasyLabel for="email" value="Email" />
            <EasyInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
        </div>

        <div class="mt-4">
            <EasyLabel for="password" value="Password" />
            <EasyInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
        </div>

        <div class="block mt-4">
            <label class="flex items-center">
                <EasyCheckbox name="remember" v-model:checked="form.remember" />
                <span class="ml-2 text-sm text-gray-600">Remember me</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <Link v-if="canResetPassword" :href="route('admin.password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
                Forgot your password?
            </Link>

            <EasyButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Log in
            </EasyButton>
        </div>
    </form>
</template>

<script>
import EasyButton from '@/Components/Form/Buttons/Button.vue'
import EasyCheckbox from '@/Components/Form/Checkbox.vue'
import EasyGuestLayout from '@/Layouts/Guest.vue'
import EasyInput from '@/Components/Form/Input.vue'
import EasyLabel from '@/Components/Form/Label.vue'
import EasyValidationErrors from '@/Components/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    layout: EasyGuestLayout,

    components: {
        EasyButton,
        EasyCheckbox,
        EasyInput,
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
            form: this.$inertia.form({
                email: '',
                password: '',
                remember: false
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('admin.login'), {
                onFinish: () => this.form.reset('password'),
            })
        }
    }
}
</script>
