<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TertiaryButton from '@/Components/TertiaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { router } from '@inertiajs/vue3';

defineProps(['restaurants']);

function truncateString(str, maxLength) {
  if (str.length <= maxLength) {
    return str;
  }

  let truncated = '';
  let charCount = 0;

  for (let i = 0; i < str.length; i++) {
    let char = str.charAt(i);

    if (/[\uD800-\uDBFF]/.test(char)) {
      // サロゲートペアの最初の文字の場合
      if (charCount + 2 <= maxLength) {
        truncated += char;
        charCount += 2;
      } else {
        break;
      }
    } else {
      // サロゲートペア以外の場合
      if (charCount + 1 <= maxLength) {
        truncated += char;
        charCount += 1;
      } else {
        break;
      }
    }
  }

  // 省略記号を追加
  truncated += '...';
  return truncated;
}
</script>

<template>
    <AuthenticatedLayout>
        <h2>お店リスト</h2>
        <form>
            <input />
            <TertiaryButton>検索</TertiaryButton>
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
                <tr v-for="restaurant in restaurants" :key="restaurant.id">
                    <td>{{ restaurant.id }}</td>
                    <td>{{ restaurant.name }}</td>
                    <td>{{ restaurant.category }}</td>
                    <td>{{ restaurant.review }}</td>
                    <td>{{ truncateString(restaurant.comment, 20) }}</td>
                    <td><PrimaryButton @click="router.get(route('restaurants.show', {
                      restaurant: restaurant.id,
                    }))">詳細</PrimaryButton></td>
                    <td><SecondaryButton>編集</SecondaryButton></td>
                    <td><DangerButton>削除</DangerButton></td>
                </tr>
            </tbody>
        </table>
    </AuthenticatedLayout>
</template>
