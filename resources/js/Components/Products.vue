<script setup>
import { router } from "@inertiajs/vue3"
    const props = defineProps(['products'])

    const addToCart = (product) => {
        router.post('/carts', product)
    }
</script>

<template>
    <div class="my-5">
                <div class="grid md:grid-cols-4 sm:grid-cols-3 grid-cols-2 lg:grid-cols-5 gap-5">
                    <div v-for="product in props.products" :key="product">
                        <div class="rounded shadow-md p-3 bg-white">
                            <div class="mb-3">
                            <img :src="`../../storage/${product.image}`" class="h-32 mx-auto" alt="">
                            </div>
                            <h3 class="text-sm md:text-base font-bold text-center">{{ product.name }}</h3>
                        </div>
                        <button @click="addToCart(product)" class="bg-teal-400 text-white w-full px-3 hover:bg-teal-500 py-2 rounded shadow text-center text-xs md:text-sm"><font-awesome-icon icon="fa-solid fa-cart-plus" /> <span class="ml-2">Tambah Keranjang</span></button>
                    </div>
                </div>
            </div>
</template>
