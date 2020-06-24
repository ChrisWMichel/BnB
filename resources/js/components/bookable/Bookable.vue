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
            <review-list></review-list>
        </div>
        <div class="col-md-4 pb-4">
            <availability></availability>
        </div>

    </div>
</template>

<script>
    import Availability from "./Availability";
    import ReviewList from "../bookables/ReviewList";

    export default {
        name: "Bookable",
        components: {ReviewList, Availability},
        data(){
            return {
                bookable: null,
                loading: false
            }
        },
        async created() {
            this.loading = true;
             axios.get(`/api/bookables/${this.$route.params.id}`)
            .then(resp => {
                this.bookable = resp.data;
                this.loading = false;
            })
            .catch(error => console.log(error.response.data))
        }
    }
</script>

<style scoped>

</style>
