<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TertiaryButton from '@/Components/TertiaryButton.vue';
import { router, useForm } from '@inertiajs/vue3';

const props = defineProps({
    restaurant: {
        type: Object,
        required: true,
    },
    type: {
        type: String,
        default: 'show',
        validator(value) {
            return ['show', 'store', 'update'].includes(value)
        },
    },
});

const form = useForm(props.restaurant);

function back() {
    history.back();
}
</script>

<template>
    <AuthenticatedLayout>
        <div>
            <h2>{{ restaurant.name }} 詳細</h2>
            <p>{{ restaurant.name_katakana }}</p>
            <div>
                <div>
                    <h3>カテゴリー</h3>
                    <ul>
                        <li v-for="category in restaurant.categories" data-my-translate="no">{{ category }}</li>
                    </ul>
                </div>
                <div>
                    <h3>レビュー</h3>
                    <p>{{ restaurant.review }}</p>
                </div>
            </div>
            <h3>料理写真</h3>
            <img :src="restaurant.image_url" alt="料理写真">
            <h3>Google Maps URL</h3>
            <a :href="restaurant.map_url" target="_blank" rel="noopener noreferrer">{{ restaurant.map_url }}</a>
            <h3>コメント</h3>
            <p>{{ restaurant.comment }}</p>
            <div v-if="type === 'show'">
                <TertiaryButton  @click="router.get(route('restaurants.index'))">お店リストに戻る</TertiaryButton>
            </div>
            <div v-else-if="type === 'store'">
                <TertiaryButton  @click="back()">戻る</TertiaryButton>
                <PrimaryButton  @click="form.post(route('restaurants.store'))">登録する</PrimaryButton>
            </div>
            <div v-else-if="type === 'update'">
            </div>
        </div>
    </AuthenticatedLayout>
</template>
