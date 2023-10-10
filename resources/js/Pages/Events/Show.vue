<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import Modal from '@/Components/Modal.vue';
import { Head, useForm, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';


const props = defineProps({
    event: Object,
    teams: Array,
    places: Array,
    competitions: Array,
    emblems: Array
})

const showTeamFormModal = ref(false)
const showPlacesFormModal = ref(false)
const showCompetitionsFormModal = ref(false)
const showDeleteTeamModal = ref(false)
const showDeletePlaceModal = ref(false)
const showDeleteCompetitionModal = ref (false)

let selectedTeam = null
let selectedPlace = null
let selectedCompetition = null

const teamForm = useForm({
    event_id: props.event.id,
    name: '',
    description: ''
})

const placeForm = useForm({
    label: '',
    emblem: '',
    default_weight: 1,
    event_id: props.event.id
})

const competitionForm = useForm({
    name: '',
    in_charge: '',
    event_id: props.event.id
})

function submitTeam() {
    if(selectedTeam) updateTeam()
    else createTeam()
}

function createTeamForm() {
    showTeamFormModal.value = true;
    selectedTeam = null
    teamForm.name = ''
    teamForm.description = ''
}

function createTeam() {
    teamForm.post('/teams', {
        onSuccess: () => {
            showTeamFormModal.value=false
            teamForm.name = ''
            teamForm.description = ''
        }
    })
}

function updateTeam() {
    teamForm.patch('/teams/' + selectedTeam.id,{
        onSuccess: () =>{
            showTeamFormModal.value=false
            teamForm.name = ''
            teamForm.description = ''
        }
    })
}

function deleteTeam(team) {
    showDeleteTeamModal.value = true;
    selectedTeam = team
}

function confirmDeleteTeam() {
    router.visit('/teams/' + selectedTeam.id,{
        method: 'delete',
        onSuccess: ()=>{
            showDeleteTeamModal.value = false
            selectedTeam = null
        }
    })
}

function editTeam(team) {
    teamForm.name = team.name,
    teamForm.description = team.description,
    teamForm.event_id = team.event_id

    selectedTeam = team

    showTeamFormModal.value = true
}

//Places

function submitPlaces() {
    if(selectedPlace) {
        placeForm.patch('/places/' + selectedPlace.id,{
            onSuccess: () => successPlacesCb()
        })
    } else {
        placeForm.post('/places',{
            onSuccess: () => successPlacesCb()
        })
    }
}

function successPlacesCb() {
    showPlacesFormModal.value = false
    clearPlaceForm()
    selectedPlace = null
}

function clearPlaceForm() {
    placeForm.label = ''
    placeForm.default_weight = 1
    placeForm.emblem = ''
}

function deletePlace(place) {
    selectedPlace = place
    showDeletePlaceModal.value = true
}

function confirmDeletePlace() {
    router.visit('/places/' + selectedPlace.id, {
        method: 'delete',
        onSuccess: () => successPlacesCb()
    })
}

function editPlace(place) {
    selectedPlace = place
    placeForm.label = place.label
    placeForm.default_weight = place.default_weight
    placeForm.emblem = place.emblem
    showPlacesFormModal.value = true
}


//Competition

function submitCompetition() {
    if(selectedCompetition) {
        competitionForm.patch('/competitions/' + selectedCompetition.id,{
            onSuccess: () => successCompetitionCb()
        })
    }else {
        competitionForm.post('/competitions',{
            onSuccess: () => successCompetitionCb()
        })
    }
}

function createCompetition() {
    showCompetitionsFormModal.value = true;
    selectedCompetition = null;
    clearCompetitionForm()
}

function successCompetitionCb() {
    selectedCompetition = null
    clearCompetitionForm()
    showCompetitionsFormModal.value = false
}

function clearCompetitionForm() {
    competitionForm.name = ''
    competitionForm.in_charge = ''
}

function editCompetition(competition) {
    selectedCompetition = competition
    competitionForm.name = competition.name
    competitionForm.in_charge = competition.in_charge
    showCompetitionsFormModal.value = true
}

function deleteCompetition(competition) {
    selectedCompetition = competition
    showDeleteCompetitionModal.value = true
}

function confirmDeleteCompetition() {
    router.visit('/competitions/' + selectedCompetition.id, {
        method: 'delete',
        onSuccess: () => {
            successCompetitionCb()
        }
    })
}

</script>

<template>


    <Modal :show="showTeamFormModal">
        <div class="p-8">
            <h4 class="text-xl mb-3">Team Entry Form</h4>
            <form @submit.prevent="submitTeam">
                <input type="hidden" v-model="teamForm.event_id">
                <div class="mb-4">
                    <label for="name">Name</label>
                    <input type="text" id="name" v-model="teamForm.name" />
                    <div class="text-red-700 italic text-sm" v-if="teamForm.errors.name">{{ teamForm.errors.name }}</div>
                </div>
                <div class="mb-4">
                    <label for="description">Description</label>
                    <input type="text" id="description" v-model="teamForm.description" />
                    <div class="text-red-700 italic text-sm" v-if="teamForm.errors.description">{{ teamForm.errors.description }}</div>
                </div>
                <hr>
                <div class="flex justify-between mt-4">
                    <SecondaryButton @click="showTeamFormModal=false">Close</SecondaryButton>
                    <PrimaryButton type="submit">Submit</PrimaryButton>
                </div>
            </form>
        </div>
    </Modal>
    <Modal :show="showDeleteTeamModal">
        <div class="p-8">
            <div class="p-6 bg-red-100 text-red-700 rounded">
                You are about to delete the team {{ selectedTeam.name }}
            </div>
            <hr class="my-4">
            <div class="flex justify-between">
                <SecondaryButton @click="selectedTeam = null; showDeleteTeamModal=false">Cancel</SecondaryButton>
                <PrimaryButton @click="confirmDeleteTeam()">Delete</PrimaryButton>
            </div>
        </div>
    </Modal>
    <Modal :show="showPlacesFormModal">
        <div class="p-8">
            <h4 class="text-xl mb-3">Winning Places Entry Form</h4>
            <form @submit.prevent="submitPlaces">
                <input type="hidden" v-model="placeForm.event_id">
                <div class="mb-4">
                    <label for="label">Label</label>
                    <input type="text" id="label" v-model="placeForm.label" />
                    <div class="text-red-700 italic text-sm" v-if="placeForm.errors.label">{{ placeForm.errors.label }}</div>
                </div>
                <div class="mb-4">
                    <label for="default_weight">Default Weight</label>
                    <input type="number" id="default_weight" v-model="placeForm.default_weight" />
                    <div class="text-red-700 italic text-sm" v-if="placeForm.errors.default_weight">{{ placeForm.errors.default_weight }}</div>
                </div>
                <div class="mb-4">
                    <label for="emblem">Emblem</label>
                    <select id="emblem" v-model="placeForm.emblem">
                        <option v-for="emblem in emblems" :value="emblem">{{ emblem }}</option>
                    </select>
                    <div class="text-red-700 italic text-sm" v-if="placeForm.errors.emblem">{{ placeForm.errors.emblem }}</div>
                </div>
                <hr>
                <div class="flex justify-between mt-4">
                    <SecondaryButton @click="showPlacesFormModal=false">Close</SecondaryButton>
                    <PrimaryButton type="submit">Submit</PrimaryButton>
                </div>
            </form>
        </div>
    </Modal>
    <Modal :show="showDeletePlaceModal">
        <div class="p-8">
            <div class="p-6 bg-red-100 text-red-700 rounded">
                You are about to delete the winning place {{ selectedPlace.label }} <br>
                Please note that this action will delete all the entries associated with
                this winning place. <strong>Advice Caution.</strong>
            </div>
            <hr class="my-4">
            <div class="flex justify-between">
                <SecondaryButton @click="selectedPlace = null; showDeletePlaceModal=false">Cancel</SecondaryButton>
                <PrimaryButton @click="confirmDeletePlace()">Delete</PrimaryButton>
            </div>
        </div>
    </Modal>

    <Modal :show="showCompetitionsFormModal">
        <div class="p-8">
            <h4 class="text-xl mb-3">Competitions Entry Form</h4>
            <form @submit.prevent="submitCompetition">
                <input type="hidden" v-model="competitionForm.event_id">
                <div class="mb-4">
                    <label for="name">Name</label>
                    <input type="text" id="name" v-model="competitionForm.name" />
                    <div class="text-red-700 italic text-sm" v-if="competitionForm.errors.name">{{ competitionForm.errors.name }}</div>
                </div>
                <div class="mb-4">
                    <label for="in_charge">In-Charge</label>
                    <input type="text" id="in_charge" v-model="competitionForm.in_charge" />
                    <div class="text-red-700 italic text-sm" v-if="competitionForm.errors.in_charge">{{ competitionForm.errors.in_charge }}</div>
                </div>

                <hr>
                <div class="flex justify-between mt-4">
                    <SecondaryButton @click="showCompetitionsFormModal=false">Close</SecondaryButton>
                    <PrimaryButton type="submit">Submit</PrimaryButton>
                </div>
            </form>
        </div>
    </Modal>
    <Modal :show="showDeleteCompetitionModal">
        <div class="p-8">
            <div class="p-6 bg-red-100 text-red-700 rounded">
                You are about to delete the competition {{ selectedCompetition.name }} <br>
                Please note that this action will delete all the entries associated with
                this competition. <strong>Advice Caution.</strong>
            </div>
            <hr class="my-4">
            <div class="flex justify-between">
                <SecondaryButton @click="selectedPlace = null; showDeleteCompetitionModal=false">Cancel</SecondaryButton>
                <PrimaryButton @click="confirmDeleteCompetition()">Delete</PrimaryButton>
            </div>
        </div>
    </Modal>

    <Head title="Setup Event" />

    <AuthenticatedLayout>

        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Setup Event: {{ event?.title }}
                </h2>
                <div class="flex">
                    <PrimaryButton @click="router.visit('/events/' + event.id + '/manage')">Manage</PrimaryButton>
                </div>
            </div>
        </template>

        <div class="py-12 px-8">
            <div class="flex gap-4">
                <div class="bg-white w-[30%] rounded-lg p-8 shadow">
                    <div class="flex justify-between pb-4 border-b border-gray-300">
                        <h4 class="text-2xl">Teams</h4>
                        <PrimaryButton @click="createTeamForm()">
                            Create Team
                        </PrimaryButton>
                    </div>
                    <ul>
                        <li
                            v-for="team in teams"
                            class="p-2 rounded bg-gray-100 border border-gray-200 mt-2 flex justify-between"
                            :key="team.id">
                                <div>
                                    {{ team.name }}
                                    <div class="italic text-gray-400 text-sm">{{ team.description }}</div>
                                </div>
                                <div class="flex items-center gap-1">
                                    <i class="fa fa-trash text-red-700 cursor-pointer" @click="deleteTeam(team)"></i>
                                    <i class="fa fa-edit text-blue-600 cursor-pointer" @click="editTeam(team)"></i>
                                </div>
                        </li>
                    </ul>

                    <div class="flex justify-between pb-4 mt-8 border-b border-gray-300">
                        <h4 class="text-2xl">Winning Places</h4>
                        <PrimaryButton @click="showPlacesFormModal=true">
                            Create Place
                        </PrimaryButton>
                    </div>
                    <ul>
                        <li
                            v-for="place in places"
                            class="p-2 rounded bg-gray-100 border border-gray-200 mt-2 flex justify-between"
                            :key="place.id">
                                <div class="flex gap-2">
                                    <img :src="'.' + place.emblem" class="h-[30px]" alt=""> {{ place.label }} ({{ place.default_weight }} points)
                                </div>
                                <div class="flex items-center gap-1">
                                    <i class="fa fa-trash text-red-700 cursor-pointer" @click="deletePlace(place)"></i>
                                    <i class="fa fa-edit text-blue-600 cursor-pointer" @click="editPlace(place)"></i>
                                </div>
                        </li>
                    </ul>
                </div>

                <div class="bg-white flex-1 rounded-lg p-8 shadow">
                    <div class="flex justify-between pb-4 border-b border-gray-300">
                        <h4 class="text-2xl">Competitions</h4>
                        <PrimaryButton @click="createCompetition()">
                            Create Competition
                        </PrimaryButton>
                    </div>
                    <ul class="flex gap-2 flex-wrap justify-between">
                        <li
                            v-for="comp in competitions"
                            class="p-2 rounded bg-gray-100 border border-gray-200 mt-2 flex justify-between w-[48%]"
                            :key="comp.id">
                                <div>{{ comp.name }}</div>
                                <div class="flex items-center gap-1">
                                    <i class="fa fa-trash text-red-700 cursor-pointer" @click="deleteCompetition(comp)"></i>
                                    <i class="fa fa-edit text-blue-600 cursor-pointer" @click="editCompetition(comp)"></i>
                                </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
