<template>
     <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <template v-if="menu.length > 0">
            <template v-for="menuItem in menu" :key="menuItem.id">
                <template v-if="menuItem.children.length > 0" >
                    <BreezeDropdown align="left" width="48">
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
                                <BreezeDropdownLink :href="route(childItem.route)">
                                    {{childItem.name}}
                                </BreezeDropdownLink>
                            </template>
                        </template>
                    </BreezeDropdown>
                </template>
                <template v-else>
                    <BreezeNavLink :href="route(menuItem.route)" :active="route().current(menuItem.rout)">
                        {{menuItem.name}}
                    </BreezeNavLink>
                </template>
            </template>
        </template>
    </div>
</template>

<script>
import BreezeNavLink from '@/Components/NavLink.vue'
import BreezeDropdown from '@/Components/Dropdown.vue'
import BreezeDropdownLink from '@/Components/DropdownLink.vue'
export default {
    props:{
        menu : {
            type: Array,
            required: true
        }
    },
    components: {
        BreezeNavLink,
        BreezeDropdown,
        BreezeDropdownLink
    }
}
</script>
