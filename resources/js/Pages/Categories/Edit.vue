<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TertiaryButton from '@/Components/TertiaryButton.vue';
import InputItem from '@/Components/InputItem.vue';
import InputError from '@/Components/InputError.vue';
import { useForm, router } from '@inertiajs/vue3';

const props = defineProps(['category']);

const form = useForm({
    name: props.category.name,
});

function back() {
    router.get(route('categories.index'));
}

function update() {
    form.put(route('categories.update', props.category.id));
}
</script>

<template>
    <AuthenticatedLayout>
        <h2>カテゴリ編集</h2>
        <form @submit.prevent="form.put(route('categories.update', category.id))">
            <InputItem label="カテゴリー名" required>
                <input v-model="form.name" />
            </InputItem>
            <InputError :message="form.errors.name" />
            <TertiaryButton @click="back()">戻る</TertiaryButton>
            <PrimaryButton @ckick="update()">修正</PrimaryButton>
        </form>
    </AuthenticatedLayout>
</template>
