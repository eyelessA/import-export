<script>
import { Link } from '@inertiajs/vue3'

export default {
    name: "Index",

    components: {
        Link
    },

    props: [
        'products'
    ]
}
</script>

<template>
    <div v-for="product in products">
        <Link :href="`/products/${product.id}`">{{ product.name }}</Link>
    </div>
</template>

<style scoped>
/* Ваши стили */
</style>
