
<script setup>

import { Head, Link } from "@inertiajs/vue3"
import HomeLayout from "@/Layouts/HomeLayout.vue"
import AccountLayout from "@/Layouts/AccountLayout.vue";
import CompTable from "@/Components/CompTable.vue";

const columns = [
    "image", "product name", "qty", "total_price"
]

</script>

<template>
    <Head :title="$page.props.title" />

    <HomeLayout>
        <AccountLayout >
            <h3 class="mb-3 font-bold text-xl md:text-2xl">{{ $page.props.title }}</h3>
            <CompTable :columns="columns" :action="true" url="">
                <tr class="bg-white border-b" v-for="cart in $page.props.carts" :key="cart">
                    <td class="px-6 py-4">
                        <img :src="`../../../storage/${cart.product.image}`" class="w-24" alt="">
                    </td>
                    <td class="px-6 py-4">
                        {{ cart.product.name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ cart.qty }}
                    </td>
                    <td class="px-6 py-4">
                        {{ cart.total_price }}
                    </td>
                    <td class="px-6 py-4 space-x-2">
                        <Link :href="`/account/cart/${cart.product_code}`" class="font-medium text-green-600 hover:underline">Pay now</Link>
                    </td>
                </tr>
            </CompTable>

        </AccountLayout>
    </HomeLayout>
</template>
