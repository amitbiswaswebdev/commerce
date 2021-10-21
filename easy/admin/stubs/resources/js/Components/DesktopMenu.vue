<template>
     <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <template v-if="menu.length > 0">
            <template v-for="menuItem in menu" :key="menuItem.id">
                <template v-if="menuItem.children.length > 0" >
                    <EasyDropdown align="left" width="48">
                        <template #trigger>
                            <span class="inline-flex rounded-md mt-4">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    {{menuItem.name}}
                                    <i class="mdi mdi-menu-down" aria-hidden="true"></i>
                                </button>
                            </span>
                        </template>
                        <template #content>
                            <template v-for="childItem in menuItem.children" :key="childItem.id">
                                <EasyDropdownLink :href="route(childItem.route)">
                                    {{childItem.name}}
                                </EasyDropdownLink>
                            </template>
                        </template>
                    </EasyDropdown>
                </template>
                <template v-else>
                    <EasyNavLink :href="route(menuItem.route)" :active="route().current(menuItem.route)">
                        {{menuItem.name}}
                    </EasyNavLink>
                </template>
            </template>
        </template>
    </div>
</template>

<script>
import EasyNavLink from '@/Components/NavLink.vue'
import EasyDropdown from '@/Components/Dropdown.vue'
import EasyDropdownLink from '@/Components/DropdownLink.vue'
export default {
    props:{
        menu : {
            type: Array,
            required: true
        }
    },
    components: {
        EasyNavLink,
        EasyDropdown,
        EasyDropdownLink
    }
}
</script>
