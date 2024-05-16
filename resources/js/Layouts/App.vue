<template>
    <div>
        <NavBar />

        <slot name="content" />
        <slot name="modal" />

    </div>
</template>

<script>
import NavBar from '@/Components/Main/NavBar.vue'

export default {
    components: {
        NavBar
    }
}

</script>

<style></style>
