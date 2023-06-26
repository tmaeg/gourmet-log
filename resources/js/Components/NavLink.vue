<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});
</script>

<template>
    <Link
        v-if="active"
        :href="href"
        class="inline-flex w-full items-center justify-center bg-white text-base font-medium leading-10 text-amber-900"
    >
        <slot />
    </Link>
    <Link
        v-else
        :href="href"
        class="inline-flex w-full items-center justify-center border-b-2 border-transparent px-1 text-base font-medium leading-10 text-white transition duration-150 ease-in-out hover:border-gray-300 hover:text-amber-900 focus:border-gray-300 focus:text-amber-900 focus:outline-none"
    >
        <slot />
    </Link>
</template>
