<script setup>

import { Link, router } from "@inertiajs/vue3"
import { ref } from "vue"

const props = defineProps(['columns', 'action', 'url', 'title'])

const inputSearch = ref("")

const search = () => {
    router.get('/account/' + props.url + '?search=' + inputSearch.value)
}

</script>

<template>
    <div>
        <div class="mb-3">
            <div class="flex justify-between items-center">
                <div v-if="props.url">
                    <Link :href="`/account/${props.url}/create`" class="px-3 py-2 text-sm rounded bg-teal-600 text-white hover:bg-teal-700">Tambah Data</Link>
                </div>
                <div v-if="props.url">
                    <form @submit.prevent="search">
                               <div class="flex gap-x-3 items-center">
                                    <input type="text" v-model="inputSearch" class="px-3 py-2 w-full h-fit text-xs sm:text-sm rounded shadow focus:outline-none focus:border-none border-0" placeholder="Pencarian">
                                    <button class="text-gray-900 bg-white border border-gray-300 focus:outline-none h-fit hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2"><font-awesome-icon icon="fa-solid fa-magnifying-glass" /></button>
                               </div>
                            </form>
                </div>
            </div>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3" v-for="column in props.columns" :key="column">
                    {{ column }}
                </th>
                <th scope="col" class="px-6 py-3" v-if="props.action">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <slot />
        </tbody>
    </table>
</div>
    </div>
</template>
