<script setup>
import InputItem from '@/Components/InputItem.vue';
import InputError from '@/Components/InputError.vue';
import TertiaryButton from '@/Components/TertiaryButton.vue';

const props = defineProps({
    form: {
        type: Object,
        required: true,
    },
    categories: {
        type: Array,
        required: true,
    },
    onLoadImg: {
        type: Function,
        required: true,
    },
});

function prepareImage(file) {
    props.form.food_picture_file = file;
    
    // ファイルをDataURLに変換
    const reader = new FileReader();
    reader.onload = () => props.onLoadImg(reader.result);
    reader.readAsDataURL(file);
}
</script>

<template>
    <div class="flex flex-col items-start">
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
    </div>
</template>
