<script setup>

import { Head, Link, useForm, router } from "@inertiajs/vue3"
import HomeLayout from "@/Layouts/HomeLayout.vue"
import AccountLayout from "@/Layouts/AccountLayout.vue";

const props = defineProps(['category'])

const form = useForm({
    name: props.category.name
})

const add = () => {
    router.put(`/categories/${props.category.id}`, form)
}

</script>

<template>
    <Head :title="$page.props.title" />

    <HomeLayout>
        <AccountLayout :title="$page.props.title">
            <form @submit.prevent="add">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                        <input type="text" v-model="form.name" id="name" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Type Here">
                        <p class="mt-2 text-sm text-red-500" v-if="$page.props.errors && $page.props.errors.name">{{ $page.props.errors.name }}</p>
                    </div>
                </div>
                <button type="submit" class="mt-3 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Submit</button>
            </form>
        </AccountLayout>
    </HomeLayout>
</template>
