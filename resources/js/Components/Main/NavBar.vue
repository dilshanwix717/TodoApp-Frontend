<template>
    <nav class="relative flex flex-wrap items-center justify-between px-2 py-3 bg-indigo-500 mb-3">
        <div class="container px-4 mx-auto flex flex-wrap items-center justify-between">
            <div class="w-full relative flex justify-between lg:w-auto  px-4 lg:static lg:block lg:justify-start">
                <Link
                    class="text-l font-bold leading-relaxed inline-block mr-0 py-2 whitespace-nowrap uppercase text-white"
                    :href="route('dashboard')">Navbar</Link>
                <button
                    class="text-white cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none"
                    type="button" v-on:click="toggleNavbar()">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <div v-bind:class="{ 'hidden': !showMenu, 'flex': showMenu }" class="lg:flex lg:flex-grow items-center">
                <ul class="flex flex-col lg:flex-row list-none ml-auto">
                    <li class="nav-item">
                        <Link
                            class="px-3 py-2 flex items-center text-m uppercase font-bold leading-snug text-white hover:opacity-75"
                            :href="route('todo')">Todo List</Link>
                    </li>
                    <li class="nav-item">
                        <Link
                            class="px-3 py-2 flex items-center text-m uppercase font-bold leading-snug text-white hover:opacity-75"
                            :href="route('logout')" method="post" as="button" v-if="$page.props.auth.user">Log Out
                        </Link>
                        <Link
                            class="px-3 py-2 flex items-center text-m uppercase font-bold leading-snug text-white hover:opacity-75"
                            :href="route('login')" v-else>Log In</Link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
import { Link } from "@inertiajs/vue3";

export default {
    name: "pink-navbar",
    data() {
        return {
            showMenu: false,
        };
    },
    methods: {
        toggleNavbar: function () {
            this.showMenu = !this.showMenu;
        },
    },
    components: { Link },
};
</script>
