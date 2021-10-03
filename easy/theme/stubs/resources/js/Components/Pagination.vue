<template>
    <div v-if="links.length > 3" class="flex flex-wrap p-2">
      <template v-for="(link, key) in links" :key="key">
        <div v-if="link.url === null || link.active" :class="{ 'bg-gray-200': link.active }" class="mr-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded" v-html="link.label" />
        <Link v-else :href="link.url" class="mr-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500" v-html="link.label" />
      </template>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
export default {
    components: {
        Link,
    },
    props: {
        links: {
            type: Array,
            required: false,
            default: []
        }
    },
}
</script>
