<script setup>
import InputItem from "@/Components/InputItem.vue";
import InputError from "@/Components/InputError.vue";
import TertiaryButton from "@/Components/TertiaryButton.vue";

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
    <div class="flex w-64 flex-col items-start gap-4">
        <InputItem label="店名" required>
            <input
                v-model="form.name"
                class="w-64 rounded border border-gray-400 px-2 py-1"
            />
            <InputError :message="form.errors.name" />
        </InputItem>

        <InputItem label="店名　フリガナ" required>
            <input
                v-model="form.name_katakana"
                class="w-64 rounded border border-gray-400 px-2 py-1"
            />
            <InputError :message="form.errors.name_katakana" />
        </InputItem>

        <div>
            <p class="required">カテゴリー</p>
            <div class="flex flex-wrap gap-x-4 gap-y-1">
                <label
                    v-for="category in categories"
                    class="flex items-center gap-1"
                >
                    <input
                        type="checkbox"
                        v-model="form.categories"
                        :value="category.id"
                    />
                    <span class="text-sm">{{ category.name }}</span>
                </label>
            </div>
            <InputError :message="form.errors.categories" />
        </div>

        <InputItem label="レビュー (最高:5/最低:1)" required>
            <select
                v-model="form.review"
                class="w-64 rounded border border-gray-400 px-2 py-1"
            >
                <option>5</option>
                <option>4</option>
                <option>3</option>
                <option>2</option>
                <option>1</option>
            </select>
            <InputError :message="form.errors.review" />
        </InputItem>

        <InputItem label="料理画像" required>
            <input type="file" @input="prepareImage($event.target.files[0])" />
            <InputError :message="form.errors.food_picture_file" />
        </InputItem>

        <InputItem label="Google Maps URL" required>
            <input
                v-model="form.map_url"
                class="w-64 rounded border border-gray-400 px-2 py-1"
            />
            <InputError :message="form.errors.map_url" />
        </InputItem>

        <InputItem label="コメント" required>
            <input
                v-model="form.comment"
                class="w-64 rounded border border-gray-400 px-2 py-1"
            />
            <InputError :message="form.errors.comment" />
        </InputItem>

        <TertiaryButton type="submit">確認画面へ</TertiaryButton>
    </div>
</template>
