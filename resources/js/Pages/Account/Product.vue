
<script setup>

import { Head, Link, router } from "@inertiajs/vue3"
import HomeLayout from "@/Layouts/HomeLayout.vue"
import AccountLayout from "@/Layouts/AccountLayout.vue";
import CompTable from "@/Components/CompTable.vue";

const columns = [
    "image", "product_code", "name", "stock", "price"
]

const deleteData = (product) => {
    router.delete('/products/' + product)
}

</script>

<template>
    <Head :title="$page.props.title" />

    <HomeLayout>
        <AccountLayout >
            <h3 class="mb-3 font-bold text-xl md:text-2xl">{{ $page.props.title }}</h3>
            <CompTable :columns="columns" :action="true" url="products">
                <tr class="bg-white border-b" v-for="product in $page.props.products" :key="product">
                    <td class="px-6 py-4">
                        <img :src="`../../../storage/${product.image}`" class="w-24" alt="">
                    </td>
                    <td class="px-6 py-4">
                        {{ product.product_code }}
                    </td>
                    <td class="px-6 py-4">
                        {{ product.name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ product.stock }}
                    </td>
                    <td class="px-6 py-4">
                        {{ product.price }}
                    </td>
                    <td class="px-6 py-4">
                        <Link :href="`/products/${product.product_code}/edit`" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</Link>
                            <button @click="deleteData(product.product_code)" class="font-medium text-red-600 dark:text-blue-500 hover:underline">Delete</button>
                    </td>
                </tr>
            </CompTable>

        </AccountLayout>
    </HomeLayout>
</template>
