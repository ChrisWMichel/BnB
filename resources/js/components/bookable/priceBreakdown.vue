<template>
    <div>
        <h5 class="text-uppercase text-secondary font-weight-bolder">
            Price Breakdown
        </h5>
        <div v-for="(days, price) in price.breakdown" :key="days" class="pt-2 pb-2 border-bottom border-top d-flex justify-content-between">
            <span>{{days}} X ${{price}}</span>
             <span>${{ days * price}}</span>
        </div>
        <div class="pt-2 font-weight-bolder d-flex justify-content-between">
            <span>Total:</span>
             <span>${{price.total}}</span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "priceBreakdown",
        props:['price']
    }
</script>

<style scoped>

</style>
