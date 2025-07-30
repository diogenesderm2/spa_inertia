<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

 const props = defineProps({
    categories: {
        type: Array,
        required: true,
    },
    product: {
        type: Object,
        required: true,
    }
})

const form = useForm({
    ...props.product,
    category_id: props.product.category.id,
})

const update = () => {
    form.put(route('products.update', form.id), {
        onSuccess: () => {
            form.reset()
        },
    })
}
</script>

<template>

    <Head title="Editar Produto" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Editar Produto
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
                        <form @submit.prevent="update" class="relative bg-white rounded-lg shadow">
                            <div class="p-6 space-y-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="cols-span-6 sm:col-span-6">
                                        <label for="name" class="block mb-2 text-sm font-medium "
                                            :class="{ 'text-gray-900': !form.errors.name, 'text-red-700': form.errors.name }">
                                            Nome do Produto</label>
                                        <input type="text" name="name" id="name" v-model="form.name"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-grey-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            :class="{ 'bg-red-50 border-red-500 text-red-900': form.errors.name, 'bg-gray-50 border-gray-300 text-gray-900': !form.errors.name }">
                                        <div v-if="form.errors.name" class="font-sm text-red-500 mt-2">{{ form.errors.name }}</div>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="brand" class="block mb-2 text-sm font-medium "
                                            :class="{ 'text-gray-900': !form.errors.brand, 'text-red-700': form.errors.brand }">Marca</label>
                                        <input type="text" name="brand" id="brand" v-model="form.brand"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            :class="{ 'bg-red-50 border-red-500 text-red-900': form.errors.brand, 'bg-gray-50 border-gray-300 text-gray-900': !form.errors.brand }">
                                        <div v-if="form.errors.brand" class="font-sm text-red-500 mt-2">{{ form.errors.brand }}</div>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="category_id" class="block mb-2 text-sm font-medium "
                                            :class="{ 'text-gray-900': !form.errors.category_id, 'text-red-700': form.errors.category_id }">Category</label>
                                        <select name="category_id" id="category_id" v-model="form.category_id"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            :class="{ 'bg-red-50 border-red-500 text-red-900': form.errors.category_id, 'bg-gray-50 border-gray-300 text-gray-900': !form.errors.category_id }">
                                            <option value="">Select a category</option>
                                            <option v-for="category in categories" :key="category.id"
                                                :value="category.id">{{
                                                    category.name }}</option>
                                        </select>
                                        <div v-if="form.errors.category_id" class="font-sm text-red-500 mt-2">{{ form.errors.category_id }}</div>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="price" class="block mb-2 text-sm font-medium "
                                            :class="{ 'text-gray-900': !form.errors.price, 'text-red-700': form.errors.price }">Price</label>
                                        <input type="number" name="price" id="price" v-model="form.price"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            :class="{ 'bg-red-50 border-red-500 text-red-900': form.errors.price, 'bg-gray-50 border-gray-300 text-gray-900': !form.errors.price }">
                                        <div v-if="form.errors.price" class="font-sm text-red-500 mt-2">{{ form.errors.price }}</div>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="stocks" class="block mb-2 text-sm font-medium "
                                            :class="{ 'text-gray-900': !form.errors.weight, 'text-red-700': form.errors.weight }">Weight</label>
                                        <input type="number" name="stocks" id="stocks" v-model="form.weight"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            :class="{ 'bg-red-50 border-red-500 text-red-900': form.errors.weight, 'bg-gray-50 border-gray-300 text-gray-900': !form.errors.weight }">
                                        <div v-if="form.errors.weight" class="font-sm text-red-500 mt-2">{{ form.errors.weight }}</div>
                                    </div>
                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="description" class="block mb-2 text-sm font-medium "
                                            :class="{ 'text-gray-900': !form.errors.description, 'text-red-700': form.errors.description }">Description</label>
                                        <textarea name="description" id="description" v-model="form.description"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                            rows="3"
                                            :class="{ 'bg-red-50 border-red-500 text-red-900': form.errors.description, 'bg-gray-50 border-gray-300 text-gray-900': !form.errors.description }"></textarea>
                                    </div>
                                    <div class="col-span-6 sm:col-span-6">
                                        <div v-if="form.errors.description" class="font-sm text-red-500 mt-2">{{ form.errors.description }}</div>
                                    </div>
                                    <div class="col-span-6 sm:col-span-6 space-x-2">
                                        <button type="submit"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update</button>
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
