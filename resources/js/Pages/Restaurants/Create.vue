<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TertiaryButton from "@/Components/TertiaryButton.vue";
import RestaurantForm from "@/Components/RestaurantForm.vue";
import RestaurantShow from "@/Components/RestaurantShow.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    categories: {
        type: Array,
        required: true,
    },
});

const form = useForm("restaurant", {
    name: null,
    name_katakana: null,
    categories: [],
    review: [],
    food_picture_file: null,
    map_url: null,
    comment: null,
});

const confirmPushed = ref(false);
const foodPicture = ref("");

function confirm() {
    form.clearErrors();
    confirmPushed.value = true;
}
</script>

<template>
    <AuthenticatedLayout>
        <div v-if="!confirmPushed || Object.keys(form.errors).length > 0">
            <h2 class="mb-4 text-lg">お店 新規登録</h2>
            <form @submit.prevent="confirm()">
                <RestaurantForm
                    :form="form"
                    :categories="categories"
                    :on-load-img="(result) => (foodPicture = result)"
                />
            </form>
        </div>
        <div v-else class="w-96">
            <RestaurantShow
                :restaurant="form"
                :foodPicture="foodPicture"
                :categories="categories"
            />

            <div class="mt-4 flex justify-between">
                <TertiaryButton @click="confirmPushed = false"
                    >戻る</TertiaryButton
                >
                <PrimaryButton @click="form.post(route('restaurants.store'))"
                    >登録する</PrimaryButton
                >
            </div>
        </div>
    </AuthenticatedLayout>
</template>
