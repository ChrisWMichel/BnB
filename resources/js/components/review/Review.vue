<template>
    <div>
        <div class="form-group">
            <label class="text-muted">Select star rating (1 - 5)</label>
            <star-rating
                class="fa-3x"
                v-model="review.rating"
            ></star-rating>
        </div>
        <div class="form-group">
            <label for="content" class="text-muted">Describe your experience with</label>
            <textarea name="content" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <button class="btn btn-lg btn-primary btn-block">Submit</button>
    </div>
</template>

<script>
    export default {
        name: "Review",
        data(){
            return {
                review:{
                    rating:5,
                    content:null
                }
            }
        },
        // methods:{
        //     onRatingChanged(rating){
        //         console.log(rating);
        //     }
        // }
    }
</script>

<style scoped>

</style>
