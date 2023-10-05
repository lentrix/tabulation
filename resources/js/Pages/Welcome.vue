<template>
    <div class="bg-blue-500 p-4 text-center">
        <Link href="/login" class="bg-blue-100 text-blue-900 px-4 py-2 rounded">Login</Link>
    </div>
    <div class="w-screen h-screen flex justify-center items-center flex-col">
        <h1 class="text-4xl">Welcome</h1>
        <h2 class="text-2xl">Intramurals Tabulation System</h2>
        <p>This page will show the tabulation summary of the active event.</p>
        <p>Right now there is no event that is active.</p>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';


</script>
