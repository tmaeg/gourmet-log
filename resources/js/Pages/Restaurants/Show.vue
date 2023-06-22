<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { router } from '@inertiajs/vue3';

defineProps({
    restaurant: {
        type: Object,
        required: true,
    },
});
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
            <button  @click="router.get(route('restaurants.index'))">お店リストに戻る</button>
        </div>
    </AuthenticatedLayout>
</template>
