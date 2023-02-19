
<script setup>

import { Head, Link } from "@inertiajs/vue3"
import HomeLayout from "@/Layouts/HomeLayout.vue"
import AccountLayout from "@/Layouts/AccountLayout.vue";
import CompTable from "@/Components/CompTable.vue";

const columns = [
    "image", "order id", "product name", "qty", "total price", "status"
]

</script>

<template>
    <Head :title="$page.props.title" />

    <HomeLayout>
        <AccountLayout >
            <h3 class="mb-3 font-bold text-xl md:text-2xl">{{ $page.props.title }}</h3>
            <CompTable :columns="columns" :action="true" url="">
                <tr class="bg-white border-b" v-for="p in $page.props.purchase" :key="p">
                    <td class="px-6 py-4">
                        <img :src="`../../../storage/${p.product.image}`" class="w-24" alt="">
                    </td>
                    <td class="px-6 py-4">
                        {{ p.order_id }}
                    </td>
                    <td class="px-6 py-4">
                        {{ p.product.name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ p.qty }}
                    </td>
                    <td class="px-6 py-4">
                        {{ p.total_price }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-red-500" v-if="p.status == 'Error'">{{ p.status }}</span>
                        <span class="text-green-500" v-if="p.status == 'Sukses'">{{ p.status }}</span>
                        <span class="text-yellow-500" v-if="p.status == 'Pending'">{{ p.status }}</span>
                    </td>
                    <td class="px-6 py-4 space-x-2">
                        <Link :href="`/purchase/${p.token}/checkout`" class="font-medium text-green-600 hover:underline" v-if="p.status == 'Pending'">Pay now</Link>
                    </td>
                </tr>
            </CompTable>

        </AccountLayout>
    </HomeLayout>
</template>
