
<script setup>

import { Head, Link, router } from "@inertiajs/vue3"
import HomeLayout from "@/Layouts/HomeLayout.vue"
import AccountLayout from "@/Layouts/AccountLayout.vue";
import CompTable from "@/Components/CompTable.vue";

const columns = [
    "name", "created at"
]

const deleteData = (category) => {
    router.delete('/categories/' + category)
}

</script>

<template>
    <Head :title="$page.props.title" />

    <HomeLayout>
        <AccountLayout >
            <h3 class="mb-3 font-bold text-xl md:text-2xl">{{ $page.props.title }}</h3>
            <CompTable :columns="columns" :action="true" url="categories" :title="$page.props.title">
                <tr class="bg-white border-b" v-for="category in $page.props.categories" :key="category">
                    <td class="px-6 py-4">
                        {{ category.name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ category.created_at }}
                    </td>
                    <td class="px-6 py-4 space-x-2">
                        <Link :href="`/categories/${category.id}/edit`" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</Link>
                            <button @click="deleteData(category.id)" class="font-medium text-red-600 dark:text-blue-500 hover:underline">Delete</button>
                    </td>
                </tr>
            </CompTable>

        </AccountLayout>
    </HomeLayout>
</template>
