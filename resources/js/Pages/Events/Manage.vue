<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Modal from '@/Components/Modal.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';


const props = defineProps({
    event: Object,
    teams: Array,
    comps: Array,
    places: Array
})

let selectedTeam = null
let selectedComp = null

const showSetModal = ref(false)

function setPlace(team, comp) {
    showSetModal.value = true
    selectedTeam = team
    selectedComp = comp
}

function confirmSetPlace(team, comp, place) {
    console.log(team)
    router.visit('/placers', {
        method: 'post',
        data: {
            team_id: team.team_id,
            competition_id: comp.id,
            place_id: place.id
        },
        onSuccess: () => {
            selectedTeam = null
            selectedComp = null
            showSetModal.value = false
        }
    })
}

</script>

<template>

    <Modal :show="showSetModal">
        <div class="p-8">
            <h4 class="text-2xl">Set Placer</h4>
            <div>
                Team: <strong>{{ selectedTeam.team_name }}</strong> <br>
                Competition: <strong>{{ selectedComp.name }}</strong>
            </div>
            <hr class="my-4">
            <div class="flex justify-between">
                <SecondaryButton @click="showSetModal=false">Close</SecondaryButton>
                <PrimaryButton @click="confirmSetPlace(selectedTeam, selectedComp, place)" v-for="place in places">
                    <div class="flex gap-2 justify-center items-center">
                        <img :src="'../.' + place.emblem" alt="" class="h-[30px]">
                        <div>{{ place.label }}</div>
                    </div>
                </PrimaryButton>
                <PrimaryButton @click="confirmSetPlace(selectedTeam, selectedComp, 0)">
                    None
                </PrimaryButton>
            </div>
        </div>
    </Modal>

    <Head title="Manage Event" />

    <AuthenticatedLayout>

        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Manage Event: {{ event.title }}
                </h2>
                <div class="flex">
                    <PrimaryButton @click="router.visit('/events/' + event.id)">
                        Setup
                    </PrimaryButton>
                </div>
            </div>
        </template>

        <div class="py-12 px-8">
            <div vif class="p-8 bg-white rounded-lg shadow">
                <table>
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th v-for="team in teams" class="w-[11%]">{{ team.name }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="comp in comps">
                            <td>{{ comp.name }}</td>
                            <td v-for="team in comp.teams" @click="setPlace(team, comp)" class="text-center">
                                <div v-if="team.place" class="flex gap-2 justify-center items-center bg-teal-100">
                                    <img :src="'../.' + team.place.emblem" alt="emblem" class="h-[30px]">
                                    <div>{{ team.place.label }}</div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>TOTAL POINTS</th>
                            <th v-for="team in teams">{{ team.totalPoints }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

<style scoped>

table {
    width: 100%;
}

tr {
    @apply border border-gray-400 hover:bg-gray-200
}

th {
    @apply bg-gray-900 text-gray-100 p-3 border-b border-gray-400
}

td {
    @apply border-gray-400 border cursor-pointer hover:bg-gray-300 h-[30px]
}
</style>
