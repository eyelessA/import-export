<script>
import axios from 'axios';
export default {
    name: "Index",

    props: [
        'products'
    ],

    methods: {
        showProduct(productId) {
            axios.get(`/products/${productId}`)
                .then(res => {
                    console.log(res.data);
                })
        }
    }
}
</script>

<template>
    <div v-for="product in products">
        <a @click.prevent="showProduct(product.id)">{{ product.name }}</a>
    </div>
</template>

<style scoped>

</style>
