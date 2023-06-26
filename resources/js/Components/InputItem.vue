<script setup>
defineProps({
    label: {
        type: String,
        required: true,
    },
    required: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <label class="flex flex-col gap-1">
        <span
            >{{ label
            }}<span v-if="required" class="mx-2 text-red-500">*</span></span
        >
        <slot />
    </label>
</template>
