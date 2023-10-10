<template>
    <div class="bg-blue-500 p-4 flex justify-between items-center">
        <div v-if="activeEvent" class="text-white text-xl bold">{{ activeEvent.title }}</div>
        <Link href="/login" class="bg-blue-100 text-blue-900 px-4 py-2 rounded">Login</Link>
    </div>

    <div v-if="activeEvent">

        <table class="mb-14">
            <thead v-if="showHeader">
                <tr class="table-header">
                    <th class="w-[450px] min-w-[450px] text-left">
                        <button class="bg-gray-500 rounded" @click="stopScroll()">X</button>
                    </th>
                    <th v-for="team in teams" class="w-[200px]">{{ team.name }}</th>
                </tr>
            </thead>
            <thead v-on:scroll="console.log(window.scrollY)">
                <tr>
                    <th class="w-[450px] min-w-[450px]">&nbsp;</th>
                    <th v-for="team in teams" class="w-[200px]">{{ team.name }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="comp in comps">
                    <td class="w-[450px]">{{ comp.name }}</td>
                    <td v-for="team in comp.teams" class="w-[200px]">
                        <div v-if="team.place" class="flex gap-2 justify-center items-center bg-teal-100">
                            <img :src="'../.' + team.place.emblem" alt="emblem" class="h-[30px]">
                            <div>{{ team.place.label }} ({{ team.custom_weight }})</div>
                        </div>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th>TOTAL</th>
                    <th v-for="team in teams">{{ team.totalPoints }}</th>
                </tr>
            </tfoot>
        </table>
        <div>&nbsp;</div>
    </div>
    <div v-else class="w-screen h-screen flex justify-center items-center flex-col">
        <h1 class="text-4xl">Welcome</h1>
        <h2 class="text-2xl">Intramurals Tabulation System</h2>
        <p>This page will show the tabulation summary of the active event.</p>
        <p>Right now there is no event that is active.</p>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

const props = defineProps({
    activeEvent: Object,
    teams: Array,
    comps: Array
})

let scrollID

const showHeader = ref(false)

function checkScrollPosition() {
    if(window.scrollY > 100) {
        showHeader.value = true
    }else {
        showHeader.value = false
    }
}

function startScrolling(){
    scrollID = setInterval(function() {
        window.scrollBy(0, 1);
            if ((window.innerHeight + window.scrollY + 1) >= document.body.offsetHeight) {
                // Reached end of page
                clearInterval(scrollID)
                reverseScrolling();
            }
        }, 50);
}

function reverseScrolling(){
    scrollID = setInterval(function() {
        window.scrollBy(0, -1);
            if (window.scrollY<=0) {
                // Reached end of page
                clearInterval(scrollID)
                startScrolling();
            }
        }, 50);
}

function stopScroll() {
    console.log("Stop scroll.")
    clearInterval(scrollID)
}

onMounted(()=>{
    window.addEventListener('scroll', checkScrollPosition)

    startScrolling()
})

</script>

<style scoped>

table {
    /* @apply w-[100%] */
}

th {
    @apply bg-teal-800 text-white
}

td, th {
    @apply border border-gray-400
}

.table-header {
    position: fixed;
    top: 0;
}

</style>
