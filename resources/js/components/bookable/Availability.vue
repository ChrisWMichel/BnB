<template>
    <div>
        <h5 class="text-uppercase text-secondary font-weight-bolder">
            Check Availability
            <transition>
                <span v-if="noAvailability" class="text-danger">(Not Available)</span>
                <span v-if="hasAvailability" class="text-success">(Available)</span>
            </transition>

        </h5>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="from">From</label>
                <input type="date"
                       name="from"
                       class="form-control form-control-sm"
                       placeholder="Start Date"
                       v-model="from"
                       :class="[{'is-invalid': errorFor('from')}]"
                       required>
<!--                <div class="invalid-feedback" v-for="(error, index) in this.errorFor('from')" :key="index">{{error}}</div>-->
                <validation-errors :errors="errorFor('from')"></validation-errors>
            </div>

            <div class="form-group col-md-6">
                <label for="to">To</label>
                <input type="date"
                       name="to"
                       class="form-control form-control-sm"
                       placeholder="End Date"
                       v-model="to"
                       :class="[{'is-invalid': errorFor('to')}]"
                       required><!-- @keyup.enter.prevent="check"-->
<!--                <div class="invalid-feedback" v-for="(error, index) in this.errorFor('to')" :key="index">{{error}}</div>-->
                <validation-errors :errors="errorFor('to')"></validation-errors>
            </div>
        </div>
        <button class="btn btn-secondary btn-block" :disabled="loading" @click="check">
            <span v-if="!loading">Check!</span>
            <span v-if="loading">
                <i class="fas fa-spinner fa-pulse"></i>
                Checking...
            </span>
        </button>
    </div>
</template>

<script>
    import  {is422} from '../shared/utils/response';
    import validationErrors from "../shared/mixins/validationErrors";

    export default {
        name: "Availability",
        mixins:[validationErrors],
        props:{
            'bookableId':[String, Number]
        },
        data(){
            return {
                from:this.$store.state.lastSearch.from,
                to:this.$store.state.lastSearch.to,
                loading:false,
                status: null
            }
        },
        methods:{
           async check(){
                this.loading = true;
                this.status = null;

                //this.$store.commit('setLastSearch', {from: this.from, to: this.to});
                this.$store.dispatch('setLastSearch', {from: this.from, to: this.to});

                try{
                    this.status = (await axios.get(`/api/bookables/${this.bookableId}/availability?from=${this.from}&to=${this.to}`)).status;
                    this.$emit('availability', this.hasAvailability);
                } catch (e) {
                    if(is422(e)){
                        this.errors = e.response.data.errors;
                    }
                    this.status = e.response.status;
                    this.$emit('availability', this.hasAvailability);
                }
               this.loading = false
            }
        },
        computed:{
            hasErrors(){
                return 422 === this.status && this.errors !== null;
            },
            hasAvailability(){
                return 200 === this.status;
            },
            noAvailability(){
                return 404 === this.status;
            }
        }
    }
</script>

<style scoped>
    label{
        font-size: 0.7rem;
        text-transform: uppercase;
        color: gray;
        font-weight: bolder;
    }
    .is-invalid{
        border-color: #b22222;
        background-image: none;
    }
    .invalid-feedback{
        color: #b22222;
    }
</style>
