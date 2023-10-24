<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Modal from '@/Components/Modal.vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';


const props = defineProps({
    event: Object,
    teams: Array,
    comps: Array,
    places: Array
})

const form = useForm({
    place_id: 0,
    team_id: 0,
    competition_id: 0,
    custom_weight: 0
})

let selectedTeam = null
let selectedComp = null

const showSetModal = ref(false)

function setPlace(team, comp) {
    selectedTeam = team
    selectedComp = comp
    showSetModal.value = true
    form.team_id = team.team_id
    form.competition_id = comp.id
}

function confirmSetPlace() {
    form.post('/placers', {
        onSuccess: ()=>{
            showSetModal.value = false
            form.place_id = 0;
            form.team_id = 0;
            form.competition_id = 0;
            form.custom_weight = 0;
        },
        preserveScroll: true
    })
}

</script>

<template>

    <Modal :show="showSetModal">
        <div class="p-8">
            <h4 class="text-2xl">Set Placer</h4>
            <form @submit.prevent="confirmSetPlace">
                <div class="mb-4">
                    Team: <strong>{{ selectedTeam.team_name }}</strong> <br>
                    Competition: <strong>{{ selectedComp.name }}</strong>
                </div>
                <div class="mb-4">
                    <label for="custom_weight">Custom Weight</label>
                    <input type="number" id="custom_weight" v-model="form.custom_weight" />
                    <div class="text-red-700 italic text-sm" v-if="form.errors.custom_weight">{{ form.errors.custom_weight }}</div>
                </div>
                <div class="mb-4 flex gap-4 justify-center items-center flex-wrap">
                    <label v-for="place in places" class="flex gap-2">
                        <input type="radio" name="place_id" :value="place.id" @click="form.custom_weight=place.default_weight; form.place_id=place.id">
                        <img :src="'../.' + place.emblem" class="h-[24px]" alt="">
                        {{ place.label }}
                    </label>
                </div>
                <hr class="my-4">
                <div class="flex justify-between">
                    <SecondaryButton @click="showSetModal=false">Close</SecondaryButton>

                    <PrimaryButton type="submit">
                        Submit
                    </PrimaryButton>
                </div>
            </form>
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
                            <th v-for="team in teams" class="w-[12%]">{{ team.name }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="comp in comps">
                            <td>{{ comp.name }}</td>
                            <td v-for="team in comp.teams" @click="setPlace(team, comp)" class="text-center" :title="team.team_name">
                                <div v-if="team.place" class="flex gap-2 justify-center items-center bg-teal-100">
                                    <img :src="'../.' + team.place.emblem" alt="emblem" class="h-[30px]">
                                    <div>{{ team.place.label }} ({{ team.custom_weight }})</div>
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
