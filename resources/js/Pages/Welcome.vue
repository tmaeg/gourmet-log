<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Welcome" />

    <GuestLayout :logo="false" :box="false">
        <div>
            <h1>Gourmet Log</h1>
        </div>
    </GuestLayout>
</template>
