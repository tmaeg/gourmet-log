<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TertiaryButton from '@/Components/TertiaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import Pagination from '@/Components/Pagination.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { router, useForm } from '@inertiajs/vue3';

defineProps(['restaurants']);

function destroy(restaurant) {
  if(confirm('削除しますか？')) {
    router.delete(route('restaurants.destroy', {
      restaurant: restaurant.id,
    }));
  }
}

const form = useForm({
  search: (new URLSearchParams(window.location.search)).get('search'),
});

function submit() {
  if(form.search) {
    form.get(route('restaurants.index'));
  }
}
</script>

<template>
    <AuthenticatedLayout>
        <h2>お店リスト</h2>
        <form @submit.prevent="submit()">
            <input v-model="form.search" />
            <TertiaryButton type="submit">検索</TertiaryButton>
        </form>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>店名</th>
                    <th>カテゴリー</th>
                    <th>レビュー</th>
                    <th>コメント</th>
                    <th>詳細</th>
                    <th>編集</th>
                    <th>削除</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="restaurant in restaurants.data" :key="restaurant.id">
                    <td>{{ restaurant.id }}</td>
                    <td>{{ restaurant.name }}</td>
                    <td>{{ restaurant.categories }}</td>
                    <td>{{ restaurant.review }}</td>
                    <td>{{ restaurant.comment, 20 }}</td>
                    <td><PrimaryButton @click="router.get(route('restaurants.show', {
                      restaurant: restaurant.id,
                    }))">詳細</PrimaryButton></td>
                    <td><SecondaryButton @click="router.get(route('restaurants.edit', {
                      restaurant: restaurant.id,
                    }))">編集</SecondaryButton></td>
                    <td><DangerButton @click="destroy(restaurant)">削除</DangerButton></td>
                </tr>
            </tbody>
        </table>
        <Pagination :links="restaurants.links" />
    </AuthenticatedLayout>
</template>
