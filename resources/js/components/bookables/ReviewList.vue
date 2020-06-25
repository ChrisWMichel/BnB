<template>
    <div class="d-none d-md-block" style="padding: 1.25rem">
        <h5 class="text-uppercase text-secondary font-weight-bolder pt-4">Review List</h5>
        <div v-if="loading">Data is loading...</div>

        <div class="border-bottom" v-for="(review, index) in reviews" :key="index">
            <div class="row pt-4">
                <div class="col-md-6">N/A</div>
                <div class="col-md-6 d-flex justify-content-end">
                    <star-rating :value="review.rating" class="fa-lg"></star-rating>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">{{review.created_at|formatDate}}</div>
            </div>
            <div class="row pt-3 pb-4">
                <div class="col-md-12">
                   {{review.content}}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
   // import moment from 'moment'

    export default {
        name: "ReviewList",
        props:{
            'bookableId': [String, Number]
        },
        data(){
            return {
                loading:false,
                reviews: null
            }
        },
        created() {
            this.loading = true;
            //
            axios.get(`/api/bookables/${this.bookableId}/reviews`)
            .then(resp => {
                this.reviews = resp.data;
                this.loading = false;
            })
            .catch(error => {
               console.log( error.response.data.errors)
            })
        },
        // filters:{
        //     formatDate(date){
        //         if(date){
        //             return moment(String(date)).fromNow();
        //         }
        //     }
        // }
    }
</script>

<style scoped>

</style>
