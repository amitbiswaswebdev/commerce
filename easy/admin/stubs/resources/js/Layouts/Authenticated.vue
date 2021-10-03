<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <DesktopNavigation class="block h-9 w-auto" />
                </div>

                <!-- Responsive Navigation Menu -->
                <MobileNavigation class="block h-9 w-auto" />
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>

<script>
import MobileNavigation from '@/Components/MobileNavigation.vue'
import DesktopNavigation from '@/Components/DesktopNavigation.vue'

export default {
    components: {
        MobileNavigation,
        DesktopNavigation,
    }
}
</script>
