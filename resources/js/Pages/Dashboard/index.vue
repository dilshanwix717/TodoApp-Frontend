<template>
    <div>
        <AppLayout>
            <template #content>
                <h1>
                    hello
                </h1>
            </template>
        </AppLayout>
    </div>
</template>

<script>
import AppLayout from '@/Layouts/App.vue'

export default {
    name: 'Home',
    components: {
        AppLayout
    }
}

</script>

<style></style>
