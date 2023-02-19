<script setup>

import { Head, Link, useForm, router } from "@inertiajs/vue3"
import HomeLayout from "@/Layouts/HomeLayout.vue"
import AccountLayout from "@/Layouts/AccountLayout.vue";

const props = defineProps(['product'])

const form = useForm({
    image: props.product.image,
    product_code: props.product.product_code,
    name: props.product.name,
    price: props.product.price,
    stock: props.product.stock,
    description: props.product.description,
    category_id: props.product.category_id
})

const category = (e) => {
 form.category_id = e.target.value
}

const image = (e) => {
form.image = e.target.files[0]
}

const add = ()  => {
    router.post(`/products/${props.product.product_code}`, {
        _method: "put",
        image: form.image,
        product_code: form.product_code,
        name: form.name,
        price: form.price,
        stock: form.stock,
        description: form.description,
        category_id: form.category_id
    })
}

</script>

<template>
    <Head :title="$page.props.title" />

    <HomeLayout>
        <AccountLayout :title="$page.props.title">
            <form @submit.prevent="add">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar</label>
                        <input type="file"  @change="image" id="image" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Type Here">
                        <img :src="`../../../../storage/${$page.props.product.image}`" class="w-20 md:w-24" alt="">
                        <p class="mt-2 text-sm text-red-500" v-if="$page.props.errors & $page.props.errors.image">{{ $page.props.errors.image}}</p>
                    </div>
                    <div>
                        <label for="product_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Produk</label>
                        <input type="text" v-model="form.product_code" id="product_code" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Type Here">
                        <p class="mt-2 text-sm text-red-500" v-if="$page.props.errors & $page.props.errors.product_code">{{ $page.props.errors.product_code }}</p>
                    </div>
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Produk</label>
                        <input type="text" v-model="form.name" id="name" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Type Here">
                        <p class="mt-2 text-sm text-red-500" v-if="$page.props.errors & $page.props.name">{{ $page.props.name }}</p>
                    </div>
                    <div>
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                        <input type="number" v-model="form.price" id="price" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Type Here">
                        <p class="mt-2 text-sm text-red-500" v-if="$page.props.errors & $page.props.errors.price">{{ $page.props.errors.price }}</p>
                    </div>
                    <div>
                        <label for="stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock</label>
                        <input type="number" v-model="form.stock" id="stock" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Type Here">
                        <p class="mt-2 text-sm text-red-500" v-if="$page.props.errors & $page.props.errors.stock">{{ $page.props.errors.stock }}</p>
                    </div>
                    <div>
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Kategory</label>
                        <select id="category" @change="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option selected :value="$page.props.product.category.name">{{ $page.props.product.category.name }}</option>
                            <option :value="category.id" v-for="category in $page.props.categories" :key="category">
                                {{ category.name }}
                            </option>
                        </select>
                        <p class="mt-2 text-sm text-red-500" v-if="$page.props.errors & $page.props.errors.category_id">{{$page.props.errors.category_id}}</p>
                    </div>
                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi Produk</label>
                        <textarea v-model="form.description" id="description" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Type Here"></textarea>
                        <p class="mt-2 text-sm text-red-500" v-if="$page.props.errors & $page.props.errors.description">{{ $page.props.errors.description }}</p>
                    </div>

                </div>
                <button type="submit" class="mt-3 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Submit</button>
            </form>
        </AccountLayout>
    </HomeLayout>
</template>
