<script setup>

import { Link, router } from "@inertiajs/vue3"

const props = defineProps(['title'])

const logout = () => {
    router.post('logout')
}

</script>

<template>
    <div class="md:flex">
            <div class="w-2/6">
                <div class="flex gap-x-3 items-center mb-10">
                    <div>
                        <font-awesome-icon icon="fa-solid fa-circle-user" class="text-3xl sm:4xl md:text-5xl text-gray-400"   />
                    </div>
                    <div>
                        <h3 class="font-bold">{{ $page.props.auth.user.name }}</h3>
                        <Link href="/account" class="text-sm">Ubah profile</Link>
                    </div>
                    <hr class="text-gray-400">
                </div>
                <div class="space-y-4 mb-5 md:mb-0" v-if="$page.props.auth.user.role == 'Admin'">
                    <Link href="/account" class="block w-fit"><font-awesome-icon icon="fa-solid fa-user" class="text-red-400"   /> <span class="ml-2">Profile</span></Link>
                    <Link href="/purchase" class="block w-fit"><font-awesome-icon icon="fa-solid fa-cart-shopping" class="text-orange-400"   /> <span class="ml-2">Pesanan Saya</span></Link>
                    <Link href="/account/carts" class="block w-fit"><font-awesome-icon icon="fa-solid fa-cart-shopping" class="text-orange-600"   /> <span class="ml-2">Keranjang Saya</span></Link>
                    <Link href="/account/products" class="block w-fit"><font-awesome-icon icon="fa-solid fa-box" class="text-orange-400"   /> <span class="ml-2">Kelola Produk</span></Link>
                    <Link href="/account/categories" class="block w-fit"><font-awesome-icon icon="fa-solid fa-list" class="text-blue-400"   /> <span class="ml-2">Kelola Kategori</span></Link>
                    <button @click="logout"><font-awesome-icon icon="fa-solid fa-arrow-right-from-bracket" class="text-green-400" /> <span class="ml-2">Logout</span></button>
                </div>
                <div class="space-y-4" v-else>
                    <Link href="" class="block w-fit"><font-awesome-icon icon="fa-solid fa-user" class="text-red-400"   /> <span class="ml-2">Profile</span></Link>
                    <Link href="" class="block w-fit"><font-awesome-icon icon="fa-solid fa-cart-shopping" class="text-orange-400"   /> <span class="ml-2">Pesanan Saya</span></Link>
                    <button @click="logout"><font-awesome-icon icon="fa-solid fa-arrow-right-from-bracket" class="text-green-400" /> <span class="ml-2">Logout</span></button>

                </div>
            </div>
            <div class="w-full bg-white rounded shadow-md p-4">
                <div class="mb-5" v-if="props.title">
                    <h3 class="text-xl md:text-2xl font-bold">{{ props.title }}</h3>
                </div>
                <slot />
            </div>
        </div>
</template>
