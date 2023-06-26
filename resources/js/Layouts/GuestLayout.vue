<script setup>
import { Link } from "@inertiajs/vue3";

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
    <div class="flex h-screen w-screen flex-col">
        <header
            class="flex h-20 items-center justify-between bg-teal-300 px-8 text-white"
        >
            <div>
                <Link href="/" v-if="logo">
                    <h1 class="text-white sm:text-2xl">Gourmet Log</h1>
                </Link>
            </div>

            <nav class="flex gap-6 sm:gap-12">
                <Link href="/login" class="hover:underline">ログイン</Link>

                <Link href="/register" class="hover:underline">新規登録</Link>
            </nav>
        </header>
        <main v-if="box">
            <div
                v-if="box"
                class="mx-auto mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg"
            >
                <slot />
            </div>
        </main>
        <main v-else class="grow">
            <slot />
        </main>
    </div>
</template>
