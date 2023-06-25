<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TertiaryButton from '@/Components/TertiaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import Pagination from '@/Components/Pagination.vue';
import InputItem from '@/Components/InputItem.vue';
import InputError from '@/Components/InputError.vue';
import { router, useForm } from '@inertiajs/vue3';

defineProps(['categories']);

const form = useForm({
  name: null,
});

function store() {
  if(form.name) {
    form.post(route('categories.store'));
  }
}

function edit(category) {
  router.get(route('categories.edit', {
    category: category.id,
  }));
}

function destroy(category) {
  if(confirm('削除しますか？')) {
    router.delete(route('categories.destroy', {
      category: category.id,
    }));
  }
}
</script>

<template>
    <AuthenticatedLayout>
        <div>
            <h2>カテゴリー管理</h2>
            <form @submit.prevent="store()">
                <InputItem label="新規カテゴリー" required>
                    <input v-model="form.name" />
                </InputItem>
                <TertiaryButton type="submit">登録</TertiaryButton>
                <InputError :message="form.errors.name" />
            </form>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>カテゴリー</th>
                        <th>編集</th>
                        <th>削除</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="category in categories.data" :key="category.id">
                        <td>{{ category.id }}</td>
                        <td>{{ category.name }}</td>
                        <td><PrimaryButton @click="edit(category)">編集</PrimaryButton></td>
                        <td><DangerButton @click="destroy(category)">削除</DangerButton></td>
                    </tr>
                </tbody>
            </table>
            <Pagination :links="categories.links" />
        </div>
    </AuthenticatedLayout>
</template>
