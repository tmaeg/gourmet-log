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
    <label>
        <span>{{ label }}</span><span v-if="required">*</span>
        <slot />
    </label>
</template>
