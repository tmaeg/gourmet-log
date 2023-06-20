<script setup>
import { Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';
defineProps({
    logo: {
        type: Boolean,
        default: true,
    },
    box: {
        type: Boolean,
        default: true,
    },
});
</script>

<template>
    <header class="flex justify-between items-center h-20 bg-teal-300 text-white">
        <div>
            <Link href="/" v-if="logo">
                <h1>Gourmet Log</h1>
            </Link>
        </div>

        <nav class="flex gap-4">
            <Link href="/login">ログイン</Link>

            <Link href="/register">新規登録</Link>
        </nav>
    </header>
    <main v-if="box">
        <div
            v-if="box"
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
    </main>
    <main v-else>
        <slot />
    </main>
</template>
