<script>
export default {
    name: "Show",

    props: [
        'product',
        'productImage',
    ],
}
</script>

<template>
    <div class="container p-2">
        <div class="row justify-content-center">
            <div class="col-md-3 mb-3" v-for="image in productImage" :key="image.id">
                <div class="card">
                    <img :src="image.public_path" class="card-img-top rounded" style="width: 100%; height: auto;">
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title mt-1 mb-1">{{ product.data.name }}</h5>
                        <p class="card-text mb-1" style="font-size: 1em;">{{ product.data.description }}</p>
                        <span class="badge bg-light-subtle border border-light-subtle text-light-emphasis rounded-pill">{{
                                product.data.price
                            }} руб.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<style scoped>

</style>
