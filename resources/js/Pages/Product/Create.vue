<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    categories: {
        type: Array,
        required: true,
    },
})

const form = useForm({
    name: '',
    brand: '',
    category_id: '',
    price: null,
    weight: null,
    description: '',
})
</script>

<template>

    <Head title="Novo Produto" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Novo Produto
                </h2>

                <Link :href="route('products.index')"
                    class="px-3 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-md hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 focus:outline-none">
                Gerenciar Produtos</Link>
            </div>

        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center justify-center">
                    <div class="relative w-full max-w-2xl max-h-full">
                        <form @submit.prevent="route('products.store')" class="relative bg-white rounded-lg shadow">
                            <div class="p-6 space-y-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="cols-span-6 sm:col-span-6">
                                        <label for="name" class="block mb-2 text-sm font-medium text-grey-900">Nome do
                                            Produto {{ form }}</label>
                                        <input type="text" name="name" id="name" v-model="form.name"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-grey-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="brand"
                                            class="block mb-2 text-sm font-medium text-gray-900">Marca</label>
                                        <input type="text" name="brand" id="brand" v-model="form.brand"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2 5">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="category_id"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Category</label>
                                        <select name="category_id" id="category_id"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5">
                                            <option value="">Select a category</option>
                                            <option>teste</option>
                                        </select>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="price"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Price</label>
                                        <input type="number" name="price" id="price" v-model="form.price"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="stocks"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Weight</label>
                                        <input type="number" name="stocks" id="stocks"  v-model="form.weight"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5">
                                    </div>
                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="description"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Description</label>
                                        <textarea name="description" id="description" v-model="form.description"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            rows="3"></textarea>
                                    </div>
                                    <div class="col-span-6 sm:col-span-6 space-x-2">
                                        <button type="submit"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Save</button>
                                        <button type="button"
                                            class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
