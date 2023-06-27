<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TertiaryButton from "@/Components/TertiaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import Pagination from "@/Components/Pagination.vue";
import InputItem from "@/Components/InputItem.vue";
import InputError from "@/Components/InputError.vue";
import { router, useForm } from "@inertiajs/vue3";

defineProps(["categories"]);

const form = useForm({
    name: null,
});

function store() {
    if (form.name) {
        form.post(route("categories.store"), {
            onSuccess: () => form.reset(),
        });
    }
}

function edit(category) {
    router.get(
        route("categories.edit", {
            category: category.id,
        })
    );
}

function destroy(category) {
    if (confirm("削除しますか？")) {
        router.delete(
            route("categories.destroy", {
                category: category.id,
            })
        );
    }
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="flex flex-col gap-4">
            <h2 class="text-lg">カテゴリー管理</h2>
            <form @submit.prevent="store()">
                <InputItem label="新規カテゴリー" required>
                    <div class="flex items-center gap-2">
                        <input
                            v-model="form.name"
                            class="rounded border border-gray-400 px-2 py-1"
                        />
                        <TertiaryButton type="submit">登録</TertiaryButton>
                    </div>
                    <InputError :message="form.errors.name" />
                </InputItem>
            </form>
            <table>
                <thead>
                    <tr>
                        <th class="border border-gray-500 px-3 py-3">ID</th>
                        <th class="border border-gray-500 px-3 py-3">
                            カテゴリー
                        </th>
                        <th class="border border-gray-500 px-3 py-3">編集</th>
                        <th class="border border-gray-500 px-3 py-3">削除</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="category in categories.data" :key="category.id">
                        <td class="border border-gray-500 px-2 py-1">
                            {{ category.id }}
                        </td>
                        <td class="border border-gray-500 px-2 py-1">
                            {{ category.name }}
                        </td>
                        <td class="border border-gray-500 px-2 py-1">
                            <PrimaryButton @click="edit(category)"
                                >編集</PrimaryButton
                            >
                        </td>
                        <td class="border border-gray-500 px-2 py-1">
                            <DangerButton @click="destroy(category)"
                                >削除</DangerButton
                            >
                        </td>
                    </tr>
                </tbody>
            </table>
            <Pagination :links="categories.links" />
        </div>
    </AuthenticatedLayout>
</template>
