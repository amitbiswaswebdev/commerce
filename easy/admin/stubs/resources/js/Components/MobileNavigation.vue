<template>
    <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <EasyResponsiveNavLink :href="route('admin.dashboard')" :active="route().current('admin.dashboard')">
                Dashboard
            </EasyResponsiveNavLink>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ $page.props.auth.user.name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <EasyResponsiveNavLink :href="route('admin.logout')" method="post" as="button">
                    Log Out
                </EasyResponsiveNavLink>
            </div>
        </div>
    </div>
</template>


<script>
    import EasyResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default {
        components: {
            EasyResponsiveNavLink,
            Link,
        },

        data() {
            return {
                showingNavigationDropdown: false,
            }
        },
    }
</script>
