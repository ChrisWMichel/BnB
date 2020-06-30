<template>
    <div>

       <fatal-error v-if="error"></fatal-error>
        <success v-if="success">
            Thank you for leaving a review.
        </success>

        <div class="row" v-if="!success && !error">
            <div :class="[{'col-md-4':twoColumns}, {'d-none': oneColumn}]">
                <div class="card">
                    <div class="card-body">
                        <div v-if="loading">Loading...</div>
                        <div v-if="hasBooking">
                            <p>
                                Stayed at
                                <router-link :to="{name:'bookable', params:{id:booking.bookable.bookable_id}}">
                                    {{booking.bookable.title}}
                                </router-link>
                            </p>
                            <p>From: {{booking.from}} To: {{booking.to}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div :class="[{'col-md-8':twoColumns}, {'col-md-12': oneColumn}]">
                <div v-if="loading">Data is loading...</div>
                <div v-else>
                    <div v-if="alreadyReviewed">
                        <h3>You have already reviewed this booking.</h3>
                    </div>
                    <div v-else>
                        <div class="form-group">
                            <label class="text-muted">Select star rating (1 - 5)</label>
                            <star-rating
                                class="fa-3x"
                                v-model="review.rating"
                            ></star-rating>
                        </div>
                        <div class="form-group">
                            <label for="content" class="text-muted">Describe your experience with</label>
                            <textarea
                                name="content"
                                cols="30"
                                rows="10"
                                class="form-control"
                                v-model="review.content"
                                :class="[{'is-invalid': errorFor('content')}]"
                            ></textarea>
                            <validation-errors :errors="errorFor('content')"></validation-errors>
                        </div>

                        <button
                            class="btn btn-lg btn-primary btn-block"
                            @click.prevent="submit"
                            :disabled="sending"
                        >Submit</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import  {is404, is422} from '../shared/utils/response';
    import validationErrors from "../shared/mixins/validationErrors";

    export default {
        name: "Review",
        mixins:[validationErrors],
        data(){
            return {
                review:{
                    id:null,
                    rating:5,
                    content:null,
                },
                existingReview:null,
                loading:false,
                booking:null,
                error:false,
                sending:false,
                success: false
            }
        },
        async created(){
            this.review.id = this.$route.params.id;
            this.loading = true;
            // check if review already exist.

            try{
                this.existingReview = (await axios.get(`/api/reviews/${ this.review.id}`)).data;

            } catch (err) {
                if(is404(err)) {
                    try{
                        this.booking = (await axios.get(`/api/booking-by-review/${this.review.id}`)).data;
                    } catch (err) {
                        this.error = !is404(err);
                    }
                } else {
                    this.error = true;
                }
            }
            this.loading = false

        },
        computed:{
            alreadyReviewed(){
                return this.hasReview || !this.booking;
            },
            hasReview(){
                return this.existingReview !== null;
            },
            hasBooking() {
                return this.booking !== null;
            },
            oneColumn(){
                return !this.loading && this.alreadyReviewed;
            },
            twoColumns(){
               return this.loading || !this.alreadyReviewed;
            }
        },
        methods:{
            submit(){
                this.sending = true;
                this.errors = null;
                this.success = false;
                // Store the review
                axios.post(`/api/reviews`, this.review)
                .then(resp => {
                    this.success = resp.status === 201;
                    setTimeout(()=> this.$router.push({name:'bookable', params:{id:this.booking.bookable.bookable_id}}), 5000);
                })
                .catch(err => {
                    if(is422(err)){
                        const errors = err.response.data.errors;
                        if(errors['content'] && 1 === _.size(errors)){
                            this.errors = errors;
                            return;
                        }
                    }
                    this.error = true
                })
                .then(() => this.sending = false);
            }
        }
    }
</script>

<style scoped>

</style>
