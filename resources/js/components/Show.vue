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
    <div v-for="image in productImage" :key="image.id">
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" :src="image.public_path" alt="Card image cap">
            <div class="card-body">
                <p class="card-text">{{ product.data.description }}</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="">
                <div class="row">
                    <div class="col-md-4" v-for="image in productImage">
                        <img :src="image.public_path" width="100%" height="225" class="rounded object-fit-cover">
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card-body">
                        <h3 class="card-title mt-3 mb-3">name</h3>
                        <p>description</p>
                        <span class="badge bg-light-subtle border border-light-subtle text-light-emphasis rounded-pill">price руб.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
