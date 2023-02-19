<script setup>

import { Link } from "@inertiajs/vue3"

const props = defineProps(['categories', 'category'])

</script>

<template>
    <div class="flex flex-wrap gap-3">
         <Link href="/" class="px-3 py-2 rounded text-xs sm:text-sm hover:bg-gray-50 text-gray-900 bg-white">
            Semua
         </Link>
        <Link :href="`/?category=${ct.slug}`" class="px-3 py-2 rounded text-xs sm:text-sm hover:bg-gray-50 text-gray-900 bg-white" v-for="ct in props.categories" :key="ct">
            {{ ct.name }}
        </Link>
    </div>
</template>
