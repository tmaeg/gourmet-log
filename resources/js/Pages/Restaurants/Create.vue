<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputItem from '@/Components/InputItem.vue';
import TertiaryButton from '@/Components/TertiaryButton.vue';
import InputError from '@/Components/InputError.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    categories: {
        type: Array,
        required: true,
    },
    restaurant: {
        type: Object,
    },
});

const form = useForm('restaurant', {
    name: null,
    name_katakana: null,
    categories: [],
    review: [],
    food_picture: null,
    map_url: null,
    comment: null,
});

function submit() {
    form.post(route('restaurants.confirm'), { preserveState: true });
}
</script>

<template>
    <AuthenticatedLayout>
        <div>
            <h2>お店 新規登録</h2>
            <form @submit.prevent="submit()" class="flex flex-col items-start" required>
                <InputItem label="店名">
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
                        <input type="checkbox" v-model="form.categories" :value="category.id" />
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
                    <input type="file" @input="form.food_picture = $event.target.files[0]" />
                </InputItem>
                <InputError :message="form.errors.food_picture" />
                
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
    </AuthenticatedLayout>
</template>
