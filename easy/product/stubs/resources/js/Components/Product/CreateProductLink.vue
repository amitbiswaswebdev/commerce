<template>
    <EasyDropdown align="left" width="48" class="mb-4">
        <template #trigger>
            <EasyButton type="bytton">
                Creat a New <i class="mdi mdi-menu-down" aria-hidden="true"></i>
            </EasyButton>
        </template>
        <template #content>
            <template v-for="(childItem, index) in productType" :key="index">
                <EasyDropdownLink :href="getRoute(index)">
                    {{ childItem }}
                </EasyDropdownLink>
            </template>
        </template>
    </EasyDropdown>
</template>



<script>
import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'
import EasyDropdown from '@/Components/Dropdown.vue'
import EasyDropdownLink from '@/Components/DropdownLink.vue'
import EasyButton from '@/Components/Form/Buttons/Button.vue'

export default {
    components: {
        EasyDropdown,
        EasyDropdownLink,
        EasyButton
    },
    setup() {
        const productType = computed(() => usePage().props.value.types)

        const getRoute = (index) => {
            let routeName = 'admin.product.' + index + '.create'
            return route(routeName)
        }

        return { productType, getRoute }
    }
}
</script>
