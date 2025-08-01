<script setup>
import { computed } from 'vue';
import { router } from '@inertiajs/vue3';
const props = defineProps({
    name: {
        type: String,
        required: true
    },
    label: {
        type: String,
        required: true
    }
})

const sortClass = computed(() => {
    const params = new URLSearchParams(window.location.search);
    let sortBy = params.get('sort_by') || ""
    let sortDir = sortBy.charAt(0)
    let sortClass = ""

    if (sortBy.replace(/^\-+/, '') === props.name) {
        sortClass = sortDir === '-' ? 'desc' : 'asc';
    }
    return sortClass;
})

const navigate = () => {
    const urlParams = new URLSearchParams(window.location.search);
    let sortBy = urlParams.get('sort_by') || ""
    let sortDir = sortBy.charAt(0)

    sortBy = !sortDir || sortDir === '-' ? props.name : `-${props.name}`

    urlParams.set('sort_by', sortBy)
    const params = Object.fromEntries(urlParams.entries())
    router.get(route(route().current()),params)
}
</script>


<template>
    <a href="#" @click.prevent="navigate" class="sortable" :class="sortClass">
        {{ props.label }}
    </a>
</template>
