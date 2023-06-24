<script setup>
const props = defineProps({
    restaurant: {
        type: Object,
        required: true,
    },
    foodPicture: {
        type: String,
        required: true,
    },
    categories: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <h2>{{ restaurant.name }} 詳細</h2>
    <p>{{ restaurant.name_katakana }}</p>
    <div>
        <div>
            <h3>カテゴリー</h3>
            <ul>
                <li v-for="id in restaurant.categories" data-my-translate="no">
                    {{ categories.find(category => category.id === id).name }}
                </li>
            </ul>
        </div>
        <div>
            <h3>レビュー</h3>
            <p>{{ restaurant.review }}</p>
        </div>
    </div>
    <h3>料理写真</h3>
    <img :src="foodPicture" alt="料理写真">
    <h3>Google Maps URL</h3>
    <a :href="restaurant.map_url" target="_blank" rel="noopener noreferrer">{{ restaurant.map_url }}</a>
    <h3>コメント</h3>
    <p>{{ restaurant.comment }}</p>
</template>
