<script setup>
import { ref } from "vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/vue3";

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="flex min-h-screen flex-col sm:flex-row">
        <nav class="flex-none sm:w-48">
            <!-- Primary Navigation Menu -->
            <div
                class="w-screeen flex h-20 items-center justify-between bg-teal-300 px-4 text-white sm:fixed sm:h-screen sm:w-48 sm:flex-col sm:justify-normal sm:px-0"
            >
                <!-- Logo -->
                <Link :href="route('dashboard')" class="text-xl sm:mt-4"
                    >Gourmet Log</Link
                >

                <!-- Navigation Links -->
                <div class="mt-8 hidden w-full flex-col items-center sm:flex">
                    <h2
                        class="w-full border-y-2 border-white text-center leading-8"
                    >
                        MENU
                    </h2>
                    <NavLink
                        :href="route('restaurants.index')"
                        :active="route().current('restaurants.index')"
                        >お店リスト</NavLink
                    >
                    <NavLink
                        :href="route('restaurants.create')"
                        :active="route().current('restaurants.create')"
                        >お店登録/編集</NavLink
                    >
                    <NavLink
                        :href="route('categories.index')"
                        :active="route().current('categories.index')"
                        >カテゴリー管理</NavLink
                    >
                </div>

                <div class="mb-8 mt-auto hidden sm:flex sm:items-center">
                    <!-- Settings Dropdown -->
                    <div class="relative ml-3">
                        <Dropdown align="top-side-left" width="48">
                            <template #trigger>
                                <span class="inline-flex rounded-md">
                                    <button
                                        type="button"
                                        class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                                        data-my-translate="no"
                                    >
                                        {{ $page.props.auth.user.name }}

                                        <svg
                                            class="-mr-0.5 ml-2 h-4 w-4"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                            transform="scale(1,-1)"
                                            transform-origin="50% 50%"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </button>
                                </span>
                            </template>

                            <template #content>
                                <DropdownLink :href="route('profile.edit')">
                                    Profile
                                </DropdownLink>
                                <DropdownLink
                                    :href="route('logout')"
                                    method="post"
                                    as="button"
                                >
                                    Log Out
                                </DropdownLink>
                            </template>
                        </Dropdown>
                    </div>
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button
                        @click="
                            showingNavigationDropdown =
                                !showingNavigationDropdown
                        "
                        class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none"
                    >
                        <svg
                            class="h-6 w-6"
                            stroke="currentColor"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <path
                                :class="{
                                    hidden: showingNavigationDropdown,
                                    'inline-flex': !showingNavigationDropdown,
                                }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                            <path
                                :class="{
                                    hidden: !showingNavigationDropdown,
                                    'inline-flex': showingNavigationDropdown,
                                }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div
                :class="{
                    block: showingNavigationDropdown,
                    hidden: !showingNavigationDropdown,
                }"
                class="border-b border-gray-200 bg-white sm:hidden"
            >
                <div class="space-y-1 pb-3 pt-2">
                    <ResponsiveNavLink
                        :href="route('restaurants.index')"
                        :active="route().current('restaurants.index')"
                        >お店リスト</ResponsiveNavLink
                    >
                    <ResponsiveNavLink
                        :href="route('restaurants.create')"
                        :active="route().current('restaurants.create')"
                        >お店登録</ResponsiveNavLink
                    >
                    <ResponsiveNavLink
                        :href="route('categories.index')"
                        :active="route().current('categories.index')"
                        >カテゴリー管理</ResponsiveNavLink
                    >
                </div>

                <!-- Responsive Settings Options -->
                <div class="border-t border-gray-200 pb-1 pt-4">
                    <div class="px-4">
                        <div class="text-base font-medium text-gray-800">
                            {{ $page.props.auth.user.name }}
                        </div>
                        <div class="text-sm font-medium text-gray-500">
                            {{ $page.props.auth.user.email }}
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <ResponsiveNavLink :href="route('profile.edit')">
                            Profile
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            :href="route('logout')"
                            method="post"
                            as="button"
                        >
                            Log Out
                        </ResponsiveNavLink>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="grow">
            <slot />
        </main>
    </div>
</template>
