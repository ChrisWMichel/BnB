<template>
    <div>
        <nav class="navbar bg-white border-bottom navbar-light">
            <router-link class="navbar-brand mr-auto font-weight-bold" :to="{name:'home'}">Bed & Breakfast</router-link>
            <router-link class="btn nav-button" :to="{name:'home2'}">Second</router-link>
        </nav>

        <div class="container mt-4 mb-4 pr-4 pl-4">
            <router-view></router-view>
        </div>


    </div>
</template>

<script>
    export default {
        name: "Index"
    }
</script>

<style scoped>

</style>
