<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputItem from '@/Components/InputItem.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TertiaryButton from '@/Components/TertiaryButton.vue';
import InputError from '@/Components/InputError.vue';
import RestaurantShow from '@/Components/RestaurantShow.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    categories: {
        type: Array,
        required: true,
    },
});

const form = useForm('restaurant', {
    name: null,
    name_katakana: null,
    categories: [],
    review: [],
    food_picture_file: null,
    map_url: null,
    comment: null,
});

const confirmPushed = ref(false);
const foodPicture = ref('');

function confirm() {
    form.clearErrors();
    confirmPushed.value = true
}
function prepareImage(file) {
    form.food_picture_file = file;
    
    // ファイルをDataURLに変換
    const reader = new FileReader();
    reader.onload = () => {
        foodPicture.value = reader.result;
    };
    reader.readAsDataURL(file);
}
</script>

<template>
    <AuthenticatedLayout>
        <div v-if="!confirmPushed || Object.keys(form.errors).length > 0">
            <h2>お店 新規登録</h2>
            <form @submit.prevent="confirm()" class="flex flex-col items-start">
                <InputItem label="店名" required>
                    <input v-model="form.name" />
                </InputItem>
                <InputError :message="form.errors.name" />
                
                <InputItem label="店名　フリガナ" required>
                    <input v-model="form.name_katakana" />
                </InputItem>
                <InputError :message="form.errors.name_katakana" />
                
                <p class="required">カテゴリー</p>
                <div>
                    <label v-for="category in categories">
                        <input type="checkbox" v-model="form.categories" :value="category" />
                        <span>{{ category.name }}</span>
                    </label>
                </div>
                <InputError :message="form.errors.categories" />
                
                <InputItem label="レビュー (最高:5/最低:1)">
                    <select v-model="form.review">
                        <option>5</option>
                        <option>4</option>
                        <option>3</option>
                        <option>2</option>
                        <option>1</option>
                    </select>
                </InputItem>
                <InputError :message="form.errors.review" />
                
                <InputItem label="料理画像" required>
                    <input type="file" @input="prepareImage($event.target.files[0])" />
                </InputItem>
                <InputError :message="form.errors.food_picture_file" />
                
                <InputItem label="Google Maps URL" required>
                    <input v-model="form.map_url" />
                </InputItem>
                <InputError :message="form.errors.map_url" />
                
                <InputItem label="コメント" required>
                    <input v-model="form.comment" />
                </InputItem>
                <InputError :message="form.errors.comment" />
                
                <TertiaryButton type="submit">確認画面へ</TertiaryButton>
            </form>
        </div>
        <div v-else>
            <RestaurantShow :restaurant="form" :foodPicture="foodPicture" />
            
            <TertiaryButton  @click="confirmPushed = false">戻る</TertiaryButton>
            <PrimaryButton  @click="form.post(route('restaurants.store'))">登録する</PrimaryButton>
        </div>
    </AuthenticatedLayout>
</template>
