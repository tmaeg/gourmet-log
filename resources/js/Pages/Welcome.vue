<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Welcome" />

    <GuestLayout :logo="false" :box="false">
        <div class="h-full bg-[url('/storage/hero.jpg')] bg-cover bg-center">
            <div class="flex h-full items-center bg-white/50">
                <h1
                    class="h-[12rem] w-full whitespace-nowrap bg-white/60 text-center font-['Dancing_Script'] text-[4em] leading-[12rem] text-amber-900 sm:text-[6rem]"
                >
                    Gourmet Log
                </h1>
            </div>
        </div>
    </GuestLayout>
</template>
