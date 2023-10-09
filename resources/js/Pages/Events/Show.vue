<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';


const props = defineProps({
    event: Object
})

const showCreateTeamModal = ref(false)
const showCreatePlacesModal = ref(false)
const showCreateCompetitionModal = ref(false)

</script>

<template>

    <Head title="Manage Event" />

    <AuthenticatedLayout>

        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Manage Event: {{ event?.title }}
                </h2>
            </div>
        </template>

        <div class="py-12 px-8">
            <div class="flex gap-4">
                <div class="bg-white flex-1 rounded-lg p-8 shadow">
                    <div class="flex justify-between pb-4 border-b border-gray-300">
                        <h4 class="text-2xl">Teams</h4>
                        <PrimaryButton @click="showCreateTeamModal=true">
                            Create Team
                        </PrimaryButton>
                    </div>
                </div>
                <div class="bg-white flex-1 rounded-lg p-8 shadow">
                    <div class="flex justify-between pb-4 border-b border-gray-300">
                        <h4 class="text-2xl">Winning Places</h4>
                        <PrimaryButton @click="showCreatePlacesModal=true">
                            Create Place
                        </PrimaryButton>
                    </div>
                </div>
                <div class="bg-white flex-1 rounded-lg p-8 shadow">
                    <div class="flex justify-between pb-4 border-b border-gray-300">
                        <h4 class="text-2xl">Competitions</h4>
                        <PrimaryButton @click="showCreateCompetitionModal=true">
                            Create Competition
                        </PrimaryButton>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
