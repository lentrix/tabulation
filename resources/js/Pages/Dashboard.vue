<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';



const props = defineProps({
    events: Array
})

const showModal = ref(false)

</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>

        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
            </div>
        </template>

        <div class="py-12 px-8">
            <div vif class="p-8 bg-white rounded-lg shadow">There are no events.</div>
        </div>

    </AuthenticatedLayout>
</template>
