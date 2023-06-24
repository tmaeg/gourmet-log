<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import RestaurantShow from '@/Components/RestaurantShow.vue';
import TertiaryButton from '@/Components/TertiaryButton.vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    restaurant: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <AuthenticatedLayout>
        <RestaurantShow :restaurant="restaurant" :food-picture="restaurant.food_picture" />

        <TertiaryButton  @click="router.get(route('restaurants.index'))">お店リストに戻る</TertiaryButton>
    </AuthenticatedLayout>
</template>
