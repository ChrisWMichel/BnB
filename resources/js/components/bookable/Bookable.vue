<template>
    <div class="row">
        <div v-if="loading">Data is loading...</div>

        <div class="col-md-8 pb-4" v-else>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{bookable.title}}</h5>
                    <hr/>
                    <div class="card-text">
                        <p>{{bookable.description}}</p>
                        <p>Price per night: ${{bookable.price}}</p>
                    </div>
                </div>
            </div>
            <review-list :bookable-id="this.$route.params.id"></review-list>
        </div>
        <div class="col-md-4 pb-4">
            <availability :bookable-id="this.$route.params.id" @availability="checkPrice($event)" class="mb-4"></availability>

            <transition>
                <div v-if="price">
                    <price-breakdown :price="price" class="mb-4"></price-breakdown>
                    <button class="btn btn-outline-secondary btn-block">Book now</button>
                </div>
            </transition>
        </div>

    </div>
</template>

<script>
    import Availability from "./Availability";
    import ReviewList from "../bookables/ReviewList";
    import {mapState} from 'vuex';
    import PriceBreakdown from "./priceBreakdown";

    export default {
        name: "Bookable",
        components: {PriceBreakdown, ReviewList, Availability},
        data(){
            return {
                bookable: null,
                loading: false,
                price:null
            }
        },
        async created() {
            this.loading = true;
             axios.get(`/api/bookables/${this.$route.params.id}`)
            .then(resp => {
                this.bookable = resp.data;
                this.loading = false;
            })
            .catch(error => console.log(error.response.data));
        },
        computed:mapState({
            lastSearch: 'lastSearch'
        }),
        methods:{
          async checkPrice(hasAvailability){
                if(!hasAvailability){
                    this.price = null;
                    return;
                }
                try{
                    this.price = (await axios.get(`/api/bookables/${this.bookable.id}/price?from=${this.lastSearch.from}&to=${this.lastSearch.to}`)).data;
                } catch(err){
                    this.price = null;
                }
            }
        }
    }
</script>

<style scoped>

</style>
