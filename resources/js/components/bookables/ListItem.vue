<template>
    <div class="card">

        <div class="card-body">
            <h5 class="card-title">{{title}}</h5>
            <p class="card-text">
                {{content}}<br>
                Price per night: ${{price}}
            </p>
<!--            <a href="#" class="btn btn-primary">Go somewhere</a>-->
        </div>
    </div>
</template>

<script>
    export default {
        name: "ListItem",
        //props:["title", "content", "price"]
        props:{"title":String, "content":String, "price":Number},
        mounted() {

        }
    }
</script>

<style scoped>

</style>
