<script setup>

import { Head, Link, useForm, router } from "@inertiajs/vue3"
import HomeLayout from "@/Layouts/HomeLayout.vue"
import AccountLayout from "@/Layouts/AccountLayout.vue";

const props = defineProps(['cart'])

const form = useForm({
    name: "",
    phone: "",
    province: "",
    city: "",
    address: "",
    product_code: props.cart.product_code,

})

const pay = () => {
    router.post('/purchase', form)
}

</script>

<template>
    <Head :title="$page.props.title" />

    <HomeLayout>
        <AccountLayout>
            <div class="md:flex gap-x-5">
                <div>
                    <img :src="`../../../storage/${$page.props.cart.product.image}`" class="lg:w-52 md:w-48 sm:w-44 w-40" alt="">
                </div>
                <div class="w-full">
                    <div>
                        <h3 class="font-bold text-xl md:text-2xl">{{ $page.props.cart.product.name }}</h3>
                        <p class="text-sm md:text-base">{{ $page.props.cart.product.description }}</p>
                        <p class="text-sm md:text-base">Qty : {{ $page.props.cart.qty }}</p>
                        <p class="text-sm md:text-base">Total Harga : Rp. {{ $page.props.cart.total_price }}</p>
                    </div>

                    <div class="mt-5">
                        <form @submit.prevent="pay">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div>
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                                    <input type="text" v-model="form.name" id="name" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Type Here">
                                    <p class="mt-2 text-sm text-red-500" v-if="$page.props.errors && $page.props.errors.name">{{ $page.props.errors.name }}</p>
                                </div>
                                <div>
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">No. HP</label>
                                    <input type="number" v-model="form.phone" id="name" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Type Here">
                                    <p class="mt-2 text-sm text-red-500" v-if="$page.props.errors && $page.props.errors.phone">{{ $page.props.errors.phone }}</p>
                                </div>
                                <div>
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Provinsi</label>
                                    <input type="text" v-model="form.province" id="name" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Type Here">
                                    <p class="mt-2 text-sm text-red-500" v-if="$page.props.errors && $page.props.errors.province">{{ $page.props.errors.province }}</p>
                                </div>
                                <div>
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Kota</label>
                                    <input type="text" v-model="form.city" id="city" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Type Here">
                                    <p class="mt-2 text-sm text-red-500" v-if="$page.props.errors && $page.props.errors.city">{{ $page.props.errors.city }}</p>
                                </div>
                                <div>
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Alamat Lengkap</label>
                                    <input type="text" v-model="form.address" id="address" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Type Here">
                                    <p class="mt-2 text-sm text-red-500" v-if="$page.props.errors && $page.props.errors.address">{{ $page.props.errors.address }}</p>
                                </div>
                            </div>
                            <button type="submit" class="mt-3 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Checkout</button>
                        </form>
                    </div>
                </div>
            </div>
        </AccountLayout>
    </HomeLayout>
</template>
