<template>
    <div>
        <nav class="navbar navbar-expand-lg bg-white border-bottom navbar-light">
            <router-link class="navbar-brand mr-auto font-weight-bold" :to="{name:'home'}">Bed & Breakfast</router-link>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <router-link class="btn nav-link" :to="{name:'basket'}">
                        Basket
                        <span v-if="itemsInBasket" class="badge badge-secondary">{{itemsInBasket}}</span>
                    </router-link>
                </li>
                <li class="nav-item" v-if="!isLoggedIn">
                    <router-link class="nav-link" :to="{name:'register'}">Register</router-link>
                </li>
                <li class="nav-item" v-if="!isLoggedIn">
                    <router-link class="nav-link" :to="{name:'login'}">Login</router-link>
                </li>
                <li class="nav-item" v-if="isLoggedIn">
                    <a class="nav-link" href="#" @click="logout">Logout</a>
                </li>

            </ul>


        </nav>

        <div class="container mt-4 mb-4 pr-4 pl-4">
            <router-view></router-view>
        </div>


    </div>
</template>

<script>
    import {mapState, mapGetters} from 'vuex';

    export default {
        name: "Index",
        data(){
            return{
                lastSearch: this.$store.state.lastSearch
            }
        },
        computed:{
            ...mapState({
                lastSearchComputed: 'lastSearch',
                isLoggedIn: "isLoggedIn"
            }),
            ...mapGetters({
                itemsInBasket: 'itemsInBasket'
            })

        },
        methods:{
            async logout(){
                try{
                    axios.post("/logout");
                    this.$store.dispatch('logout');
                } catch (err) {
                    console.log(err.response.status);
                }
            }
        }
    }
</script>

<style scoped>

</style>
