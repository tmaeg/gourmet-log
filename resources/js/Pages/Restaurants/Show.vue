<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import RestaurantShow from "@/Components/RestaurantShow.vue";
import TertiaryButton from "@/Components/TertiaryButton.vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    restaurant: {
        type: Object,
        required: true,
    },
    categories: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <AuthenticatedLayout>
        <div class="w-96">
            <RestaurantShow
                :restaurant="restaurant"
                :food-picture="restaurant.food_picture"
                :categories="categories"
            />

            <TertiaryButton
                @click="router.get(route('restaurants.index'))"
                class="mt-4"
                >お店リストに戻る</TertiaryButton
            >
        </div>
    </AuthenticatedLayout>
</template>
