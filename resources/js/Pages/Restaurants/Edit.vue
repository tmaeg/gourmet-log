<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TertiaryButton from "@/Components/TertiaryButton.vue";
import RestaurantForm from "@/Components/RestaurantForm.vue";
import RestaurantShow from "@/Components/RestaurantShow.vue";
import { useForm, router } from "@inertiajs/vue3";
import { ref } from "vue";

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

const form = useForm({
    ...props.restaurant,
    food_picture_file: null,
});

const confirmPushed = ref(false);
const foodPicture = ref(props.restaurant.food_picture);

function confirm() {
    form.clearErrors();
    confirmPushed.value = true;
}
</script>

<template>
    <AuthenticatedLayout>
        <div v-if="!confirmPushed || Object.keys(form.errors).length > 0">
            <h2>お店 編集</h2>
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
                <PrimaryButton
                    @click="
                        router.post(route('restaurants.update', form.id), {
                            _method: 'put',
                            ...form.data(),
                        })
                    "
                    >更新する</PrimaryButton
                >
            </div>
        </div>
    </AuthenticatedLayout>
</template>
