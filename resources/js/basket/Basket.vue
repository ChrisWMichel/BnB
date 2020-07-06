<template>
    <div>
        <success v-if="success">You have successfully booked your room!</success>
        <div class="row" v-else>
            <div class="col-md-8" v-if="itemsInBasket">
                <div class="form-row">
                    <div class="col-md-6 form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" :class="[{'is-invalid': errorFor('customer.first_name')}]" name="first_name" id="first_name" v-model="customer.first_name">
                        <validation-errors :errors="errorFor('customer.first_name')"></validation-errors>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" :class="[{'is-invalid': errorFor('customer.last_name')}]" name="last_name" id="last_name" v-model="customer.last_name">
                        <validation-errors :errors="errorFor('customer.last_name')"></validation-errors>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" :class="[{'is-invalid': errorFor('customer.email')}]" name="email" id="email" v-model="customer.email">
                        <validation-errors :errors="errorFor('customer.email')"></validation-errors>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" :class="[{'is-invalid': errorFor('customer.phone')}]" name="phone" id="phone" v-model="customer.phone">
                        <validation-errors :errors="errorFor('customer.phone')"></validation-errors>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" name="street" :class="[{'is-invalid': errorFor('customer.street')}]" id="address" v-model="customer.street">
                        <validation-errors :errors="errorFor('customer.street')"></validation-errors>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" :class="[{'is-invalid': errorFor('customer.city')}]" name="city" id="city" v-model="customer.city">
                        <validation-errors :errors="errorFor('customer.city')"></validation-errors>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-5 form-group">
                        <label for="country">Country</label>
                        <input type="text" class="form-control" name="country" :class="[{'is-invalid': errorFor('customer.country')}]" id="country" v-model="customer.country">
                        <validation-errors :errors="errorFor('customer.country')"></validation-errors>
                    </div>
                    <div class="col-md-5 form-group">
                        <label for="state">State</label>
                        <input type="text" class="form-control" :class="[{'is-invalid': errorFor('customer.state')}]" name="state" id="state" v-model="customer.state">
                        <validation-errors :errors="errorFor('customer.state')"></validation-errors>
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="zipcode">Zipcode</label>
                        <input type="text" class="form-control" :class="[{'is-invalid': errorFor('customer.zipcode')}]" name="zipcode" id="zipcode" v-model="customer.zipcode">
                        <validation-errors :errors="errorFor('customer.zipcode')"></validation-errors>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <button
                            type="submit"
                            class="btn btn-lg btn-primary btn-block"
                            @click.prevent="book"
                            :disabled="loading"
                        >Book Now!</button>
                    </div>
                </div>
            </div>
            <div class="col-md-8" v-else>
                <div class="jumbotron jumbotron-fluid text-center">
                    <h1>Empty</h1>
                </div>
            </div>

            <div class="col-md-4">
                <div class="d-flex justify-content-between">
                    <h5 class="text-uppercase text-secondary font-weight-bolder">Your Cart</h5>
                    <h5 class="badge badge-secondary text-uppercase">
                        <span v-if="itemsInBasket">Bookings: {{itemsInBasket}}</span>
                        <span v-else>Empty</span>
                    </h5>
                </div>

                <transition-group>
                    <div v-for="item in basket" :key="item.bookable.id">
                        <div class="pt-2 pb-2 border-top d-flex justify-content-between">
                        <span>
                            <router-link :to="{name:'bookable', params:{id:item.bookable.id}}">{{item.bookable.title}}</router-link>
                        </span>
                            <span class="font-weight-bold">${{item.price.total}}</span>
                        </div>

                        <div class="pt-2 pb-2 d-flex justify-content-between">
                        <span>
                           From: {{item.dates.from}}
                        </span>
                            <span class="font-weight-bold">To: {{item.dates.to}}</span>
                        </div>

                        <div class="pt-2 pb-2 text-right">
                            <button class="btn btn-sm btn-outline-secondary" @click="$store.dispatch('removeFromBasket', item.bookable.id)">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                </transition-group>

            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapState} from 'vuex';
    import validationErrors from "../components/shared/mixins/validationErrors";

    export default {
        name: "Basket",
        mixins:[validationErrors],
        data(){
            return {
                loading:false,
                bookingAttempted:false,
                customer:{
                    first_name:null,
                    last_name:null,
                    phone:null,
                    email:null,
                    street:null,
                    city:null,
                    country:null,
                    zipcode:null
                }
            }
        },
        computed:{
            ...mapGetters({
                itemsInBasket: 'itemsInBasket'
            }),
            ...mapState({
                basket: state => state.basket.items
            }),
            success(){
                return !this.loading && this.itemsInBasket === 0 && this.bookingAttempted;
            }
        },
        methods:{
           async book(){
               this.loading = true;
               this.bookingAttempted = false;
               this.errors = null;

               try{
                   await axios.post('/api/checkout', {
                       customer:this.customer,
                       bookings:this.basket.map(basketItem => ({
                           bookable_id: basketItem.bookable.id,
                           from: basketItem.dates.from,
                           to:basketItem.dates.to
                       }))
                   });
                   this.$store.dispatch('clearBasket');
               } catch(err){
                   this.errors = err.response && err.response.data.errors;
               }
               this.loading = false;
               this.bookingAttempted = true;
            }
        }
    }
</script>

<style scoped>
    h5.badge{
        font-size: 100%;
    }
    a{
        color: black;
    }
</style>
