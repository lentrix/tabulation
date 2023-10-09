<script setup>
    import { ref } from 'vue';
    import { Head, useForm, router } from '@inertiajs/vue3'

    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import SecondaryButton from '@/Components/SecondaryButton.vue';
    import Modal from '@/Components/Modal.vue';

    const showModal = ref(false)

    const props = defineProps({
        events: Array
    })

    const form = useForm({
        title: "",
        description: "",
        start_date: null,
        start_time: null,
        end_date: null,
        end_time: null
    })

    function submit() {
        showModal.value = false
        form.post('/events')
    }

    function openEvent(id) {
        router.visit('/events/' + id)
    }

</script>

<template>

    <Head title="Events" />

    <AuthenticatedLayout>
        <Modal :show="showModal">
            <div class="p-8">
                <form @submit.prevent="submit">
                    <div class="mb-4">
                        <label for="title">Title</label>
                        <input type="text" id="title" v-model="form.title" />
                    </div>
                    <div class="mb-4">
                        <label for="description">Description</label>
                        <input type="text" id="description" v-model="form.description" />
                    </div>
                    <div class="mb-4">
                        <label for="start">Start Time</label>
                        <div class="flex gap-2">
                            <input type="date" id="start_date" v-model="form.start_date" class="flex-1" />
                            <input type="time" id="start_time" v-model="form.start_time" class="flex-1" />
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="start">End Time</label>
                        <div class="flex gap-2">
                            <input type="date" id="end_date" v-model="form.end_date" class="flex-1" />
                            <input type="time" id="end_time" v-model="form.end_time" class="flex-1" />
                        </div>
                    </div>
                    <div class="flex justify-between mt-4 border-t pt-4">
                        <SecondaryButton type="button" @click="showModal=false">Close</SecondaryButton>
                        <PrimaryButton type="submit">Submit</PrimaryButton>
                    </div>
                </form>
            </div>
        </Modal>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Events</h2>
                <PrimaryButton @click="showModal=true">Create Event</PrimaryButton>
            </div>
        </template>

        <div class="py-12 px-8">
            <div v-if="events.length==0" class="p-8 bg-white rounded-lg shadow">There are no events.</div>
            <div v-else class="flex flex-wrap gap-4">
                <div v-for="event in events" :key="event.id" :event="event" class="p-4 shadow bg-white rounded-lg w-[380px] cursor-pointer" @click="openEvent(event.id)">
                    <h4 class="text-3xl">{{ event.title }}</h4>
                    <div>{{ event.description }}</div>
                    <div class="flex italic text-sm text-gray-400">
                        <div>{{ event.start }}</div>
                        <div>{{ event.end }}</div>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
