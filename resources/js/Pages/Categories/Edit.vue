<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TertiaryButton from "@/Components/TertiaryButton.vue";
import InputItem from "@/Components/InputItem.vue";
import InputError from "@/Components/InputError.vue";
import { useForm, router } from "@inertiajs/vue3";

const props = defineProps(["category"]);

const form = useForm({
    name: props.category.name,
});

function back() {
    router.get(route("categories.index"));
}

function update() {
    form.put(route("categories.update", props.category.id));
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="flex flex-col gap-4">
            <h2 class="text-lg">カテゴリ編集</h2>
            <form @submit.prevent="update()" class="flex flex-col gap-4">
                <InputItem label="カテゴリー名" required>
                    <input
                        v-model="form.name"
                        class="w-64 rounded border border-gray-400 px-2 py-1"
                    />
                </InputItem>
                <InputError :message="form.errors.name" />
                <div class="flex justify-between">
                    <TertiaryButton @click="back()">戻る</TertiaryButton>
                    <PrimaryButton>修正</PrimaryButton>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
