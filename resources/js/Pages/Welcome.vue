<template>

    <Head title="Overview" />

    <div class="bg-blue-500 p-4 flex justify-between items-center">
        <div v-if="activeEvent" class="text-white text-xl bold">{{ activeEvent.title }}</div>
        <Link href="/login" class="bg-blue-100 text-blue-900 px-4 py-2 rounded">Login</Link>
    </div>

    <div v-if="activeEvent" class="px-8 py-4">
        <h4 class="text-3xl text-white">Medal Tally Page {{ page }} of {{ pages }}</h4>
        <progress :value="timer" max="20000" style="color: #4a55f8!important; background-color: #4a55f8!important;"></progress>
    </div>
    <div v-if="activeEvent" class="flex gap-8 px-8 py-4">
        <div class="flex-1">

            <table class="mb-14">
                <thead v-on:scroll="console.log(window.scrollY)">
                    <tr>
                        <th class="w-[450px] min-w-[450px]">&nbsp;</th>
                        <th v-for="team in teams" class="w-[200px]">{{ team.name }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="comp in comps">
                        <td class="w-[450px]" style="background-color: #cdeaf1!important;">{{ comp.name }}</td>
                        <td v-for="team in comp.teams" class="w-[200px]">
                            <div v-if="team.place" class="flex gap-2 justify-center items-center bg-teal-100">
                                <img :src="'../.' + team.place.emblem" alt="emblem" class="h-[60px]">
                                <!-- <div>({{ team.custom_weight }})</div> -->
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
        <div class="w-[25%]" style="opacity: 0.7;">
            <div class=" p-4 bg-gray-300 rounded-lg shadow-md border border-gray-400">
                <h4 class="text-2xl">Medal Summary</h4>
                <table>
                    <thead>
                        <tr>
                            <th width="28%">&nbsp;</th>
                            <th width="24%">Gold</th>
                            <th width="24%">Silver</th>
                            <th width="24%">Bronze</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="row in summary">
                            <td>{{ row.team }}</td>
                            <td>{{ row.Gold }}</td>
                            <td>{{ row.Silver }}</td>
                            <td>{{ row.Bronze }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div v-else class="w-screen h-screen flex justify-center items-center flex-col">
        <h1 class="text-4xl">Welcome</h1>
        <h2 class="text-2xl">Intramurals Tabulation System</h2>
        <p>This page will show the tabulation summary of the active event.</p>
        <p>Right now there is no event that is active.</p>
    </div>
</template>

<script setup>
import { Link, Head, router } from '@inertiajs/vue3';
import { onMounted, ref, onBeforeUnmount } from 'vue';

const props = defineProps({
    activeEvent: Object,
    teams: Array,
    comps: Array,
    summary: Array,
    pages: Number
})

const timer = ref(20000)

let page = (new URLSearchParams(window.location.search)).get('page')??1;
let id

let sortedSummary = props.summary?.sort((a,b)=>{

    return (a.Gold < b.Gold) ? 1 : (a.Gold > b.Gold) ? -1 : (a.Silver < b.Silver) ? 1 : (a.Silver > b.Silver) ? -1 : 0;
})

console.log(sortedSummary)

function moveNext() {
    if(page==props.pages) page = 1
    else page++

    router.visit('/?page=' + page)
}

onMounted(()=>{
    id = setInterval(()=>{
        timer.value-=100
        if(timer.value<=0) {
            clearInterval(id)
            moveNext()
        }
    }, 100)
})

onBeforeUnmount(()=>{
    clearInterval(id)
})

</script>

<style scoped>

table {
    @apply w-[100%]
}

th {
    @apply bg-blue-500 text-white
}

td, th {
    @apply border border-blue-500 text-2xl min-h-[80px] text-center;
    opacity: 0.7;
}

td {
    height: 60px!important;
    background-color: white;
}

progress {
    background-color: blue;
    color: blue;
}


</style>
