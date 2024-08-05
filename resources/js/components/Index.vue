<script>
import {Link} from '@inertiajs/vue3'

export default {
    name: "Index",

    components: {
        Link
    },

    props: [
        'products',
    ]
}
</script>

<template>
        <div class="album p-2">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 mb-5">
                    <div class="col" v-for="product in products" :key="product.id">
                        <Link :href="`/products/${product.id}`">
                            <div class="card rounded-3 d-flex flex-column h-100">
                                <img :src="product.images[0].public_path" width="100%" height="225"
                                     class="object-fit-cover rounded-top-3" alt="#">
                                <div class="card-body d-flex flex-column flex-grow-1 p-4">
                                    <h5 class="card-title">{{ product.name }}</h5>
<!--                                    <p class="card-text">{{ product.description }}</p>-->
                                    <div class="d-flex justify-content-between align-items-center mt-auto">
                                        <div class="btn-group">
                                            <button class="btn btn-outline-secondary d-inline-flex align-items-center"
                                                    type="button">
                                                Посмотреть
                                            </button>
                                        </div>

                                        <span
                                            class="badge bg-light-subtle border border-light-subtle text-light-emphasis rounded-pill">{{
                                                product.price
                                            }} руб.</span>
                                    </div>
                                </div>
                            </div>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
</template>

<style scoped>
</style>
