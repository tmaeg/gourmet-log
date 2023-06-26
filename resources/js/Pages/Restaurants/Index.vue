<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TertiaryButton from "@/Components/TertiaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import Pagination from "@/Components/Pagination.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { router, useForm } from "@inertiajs/vue3";

defineProps(["restaurants"]);

function destroy(restaurant) {
    if (confirm("削除しますか？")) {
        router.delete(
            route("restaurants.destroy", {
                restaurant: restaurant.id,
            })
        );
    }
}

const form = useForm({
    search: new URLSearchParams(window.location.search).get("search"),
});

function submit() {
    if (form.search) {
        form.get(route("restaurants.index"));
    }
}

function stars(review) {
    // reviewの数だけ★を表示する　例：reviewが3なら★★★☆☆
    return "★".repeat(review) + "☆".repeat(5 - review);
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="flex flex-col gap-4 self-start sm:self-auto">
            <h2 class="text-lg">お店リスト</h2>
            <form @submit.prevent="submit()" class="flex items-center gap-2">
                <input
                    v-model="form.search"
                    class="rounded border border-gray-400 px-2 py-1"
                />
                <TertiaryButton type="submit">検索</TertiaryButton>
            </form>
            <table>
                <thead>
                    <tr>
                        <th class="border border-gray-500 px-3 py-3">ID</th>
                        <th class="border border-gray-500 px-3 py-3">店名</th>
                        <th class="border border-gray-500 px-3 py-3">
                            カテゴリー
                        </th>
                        <th class="border border-gray-500 px-3 py-3">
                            レビュー
                        </th>
                        <th class="border border-gray-500 px-3 py-3">
                            コメント
                        </th>
                        <th class="border border-gray-500 px-3 py-3">詳細</th>
                        <th class="border border-gray-500 px-3 py-3">編集</th>
                        <th class="border border-gray-500 px-3 py-3">削除</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="restaurant in restaurants.data"
                        :key="restaurant.id"
                    >
                        <td class="border border-gray-500 px-2 py-1">
                            {{ restaurant.id }}
                        </td>
                        <td class="border border-gray-500 px-2 py-1">
                            {{ restaurant.name }}
                        </td>
                        <td class="border border-gray-500 px-2 py-1 text-sm">
                            {{ restaurant.categories }}
                        </td>
                        <td
                            class="border border-gray-500 px-2 py-1 text-yellow-500"
                        >
                            {{ stars(restaurant.review) }}
                        </td>
                        <td class="border border-gray-500 px-2 py-1">
                            {{ restaurant.comment }}
                        </td>
                        <td class="border border-gray-500 px-2 py-1">
                            <PrimaryButton
                                @click="
                                    router.get(
                                        route('restaurants.show', {
                                            restaurant: restaurant.id,
                                        })
                                    )
                                "
                                >詳細</PrimaryButton
                            >
                        </td>
                        <td class="border border-gray-500 px-2 py-1">
                            <SecondaryButton
                                @click="
                                    router.get(
                                        route('restaurants.edit', {
                                            restaurant: restaurant.id,
                                        })
                                    )
                                "
                                >編集</SecondaryButton
                            >
                        </td>
                        <td class="border border-gray-500 px-2 py-1">
                            <DangerButton @click="destroy(restaurant)"
                                >削除</DangerButton
                            >
                        </td>
                    </tr>
                </tbody>
            </table>
            <Pagination :links="restaurants.links" />
        </div>
    </AuthenticatedLayout>
</template>
