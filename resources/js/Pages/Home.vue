<script setup>

import { Head } from "@inertiajs/vue3"
import HomeLayout from "@/Layouts/HomeLayout.vue"
import Products from "@/Components/Products.vue"
import Category from "@/Components/Category.vue"

</script>

<template>
        <Head title="Tempat pembelian barang menarik" />

        <HomeLayout>
            <Category :categories="$page.props.categories" />
            <Products :products="$page.props.products" />
        </HomeLayout>
</template>
