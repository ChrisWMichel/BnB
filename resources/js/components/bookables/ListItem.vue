<template>
    <div class="card w-100">
        <div class="card-body">
            <router-link :to="{name:'bookable', params:{id}}">
                <h5 class="card-title">{{title}}</h5>
            </router-link>
            <div class="card-text">
                <p>{{description}}</p>
                <p>Price per night: ${{price}}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ListItem",
        //props:["title", "content", "price"]
        props:{"title":String, "description":String, "price":Number, 'id':Number},
        mounted() {

        }
    }
</script>

<style scoped>

</style>
