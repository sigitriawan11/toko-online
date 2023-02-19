<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link, router } from '@inertiajs/vue3';

const inputSearch = ref("")

const search = () => {
    router.get('/?search=' + inputSearch.value)
}

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-teal-400 border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-16">
                    <div class="flex justify-between items-center h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link href="/" class="text-xl md:text-2xl font-bold text-white">
                                    Toko-Online
                                </Link>
                            </div>

                        </div>
                        <div class="w-1/2 md:block hidden" v-if="route().current('home')">
                            <form @submit.prevent="search">
                               <div class="flex gap-x-3 items-center">
                                    <input type="text" v-model="inputSearch" class="px-3 py-2 w-full h-fit text-xs sm:text-sm rounded shadow focus:outline-none focus:border-none border-0" placeholder="Cari barang">
                                    <button type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none h-fit hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2"><font-awesome-icon icon="fa-solid fa-magnifying-glass" /></button>
                               </div>
                            </form>
                        </div>
                        <div class="block md:hidden">
                            <NavLink href="/account/carts" class="relative">
                                    <div class="absolute -top-2 -right-1">
                                        <span class="text-teal-900">{{ $page.props.total_cart }}</span>
                                    </div>
                                    <font-awesome-icon icon="fa-solid fa-cart-shopping" class="text-lg md:text-xl" />
                                </NavLink>
                        </div>

                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex" v-if="!$page.props.auth.user">
                                <NavLink href="/account/carts">
                                    <font-awesome-icon icon="fa-solid fa-cart-shopping" class="text-lg md:text-xl" />
                                </NavLink>
                                <NavLink :href="route('register')" :active="route().current('register')">
                                    Daftar
                                </NavLink>
                                <NavLink :href="route('login')" :active="route().current('login')">
                                    Login
                                </NavLink>
                            </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex" v-else>
                                <NavLink href="/account/carts" class="relative">
                                    <div class="absolute -top-2 -right-1">
                                        <span class="text-teal-900">{{ $page.props.total_cart }}</span>
                                    </div>
                                    <font-awesome-icon icon="fa-solid fa-cart-shopping" class="text-lg md:text-xl" />
                                </NavLink>
                                <NavLink href="/account">
                                    <span class="mr-1">{{ $page.props.auth.user.name }}</span><font-awesome-icon icon="fa-solid fa-circle-user" class="text-lg md:text-xl" />
                                </NavLink>
                            </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white0 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-white0 transition duration-150 ease-in-out"
                            >
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="sm:hidden"
                >
                    <div class="p-3 space-y-1">
                        <form @submit.prevent="search">
                               <div class="flex gap-x-3 items-center">
                                    <input type="text" v-model="inputSearch" class="px-3 py-2 w-full h-fit text-xs sm:text-sm rounded shadow focus:outline-none focus:border-none border-0" placeholder="Cari barang">
                                    <button type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none h-fit hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2"><font-awesome-icon icon="fa-solid fa-magnifying-glass" /></button>
                               </div>
                            </form>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-white">
                               {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-white">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink href="/account"> Profile </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="px-6 sm:px-10 lg:px-16 py-6">
                <slot />
            </main>
        </div>
    </div>
</template>
