<template>
    <Head title="Register" />

    <EasyValidationErrors class="mb-4" />

    <form @submit.prevent="submit">
        <div>
            <EasyLabel for="name" value="Name" />
            <EasyInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
        </div>

        <div class="mt-4">
            <EasyLabel for="email" value="Email" />
            <EasyInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
        </div>

        <div class="mt-4">
            <EasyLabel for="password" value="Password" />
            <EasyInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
        </div>

        <div class="mt-4">
            <EasyLabel for="password_confirmation" value="Confirm Password" />
            <EasyInput id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <Link :href="route('admin.login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                Already registered?
            </Link>

            <EasyButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Register
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
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    layout: EasyGuestLayout,

    components: {
        EasyButton,
        EasyInput,
        EasyLabel,
        EasyValidationErrors,
        Head,
        Link,
    },

    data() {
        return {
            form: this.$inertia.form({
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                terms: false,
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('admin.register'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            })
        }
    }
}
</script>
