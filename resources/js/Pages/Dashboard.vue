<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="flex w-3/4 flex-col gap-4 text-lg">
            <p>{{ new Date().toLocaleDateString() }}</p>
            <p>{{ $page.props.auth.user.name }} さん　こんにちわ！</p>
        </div>
    </AuthenticatedLayout>
</template>
