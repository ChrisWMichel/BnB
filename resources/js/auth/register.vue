<template>
    <div class="w-50 m-auto">

        <div class="card card-body">
            <form>
                <div class="form-group">
                    <input
                        type="text"
                        name="first_name"
                        id="first_name"
                        placeholder="First name"
                        class="form-control"
                        v-model="user.first_name"
                        :class="[{'is-invalid': errorFor('first_name')}]"
                    >
                    <validation-errors :errors="errorFor('first_name')"></validation-errors>
                </div>
                <div class="form-group">
                    <input
                        type="text"
                        name="last_name"
                        id="last_name"
                        placeholder="Last name"
                        class="form-control"
                        v-model="user.last_name"
                        :class="[{'is-invalid': errorFor('last_name')}]"
                    >
                    <validation-errors :errors="errorFor('last_name')"></validation-errors>
                </div>
                <div class="form-group">
                    <input
                        type="text"
                        name="email" id="email"
                        placeholder="Email"
                        class="form-control"
                        v-model="user.email"
                        :class="[{'is-invalid': errorFor('email')}]"
                    >
                    <validation-errors :errors="errorFor('email')"></validation-errors>
                </div>
                <div class="form-group">
                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Password"
                        class="form-control"
                        v-model="user.password"
                        :class="[{'is-invalid': errorFor('password')}]"
                    >
                    <validation-errors :errors="errorFor('password')"></validation-errors>
                </div>

                <div class="form-group">
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        placeholder="Retype Password"
                        class="form-control"
                        v-model="user.password_confirmation"
                        :class="[{'is-invalid': errorFor('password_confirmation')}]"
                    >
                    <validation-errors :errors="errorFor('password_confirmation')"></validation-errors>
                </div>

                <button type="submit" class="btn btn-primary btn-lg btn-block" :disabled="loading" @click.prevent="register">Register</button>
                <hr/>

                <div>
                    Already have an account?
                    <router-link :to="{name:'login'}" class="font-weight-bold">Login</router-link>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import validationErrors from "../components/shared/mixins/validationErrors";
    import {logIn} from "../components/shared/utils/auth";

    export default {
        name: "Login",
        mixins: [validationErrors],
        data(){
            return{
                user:{
                    first_name: null,
                    last_name: null,
                    email:null,
                    password:null,
                    password_confirmation: null
                },
                loading:false

            }
        },
        methods:{
            async register(){
                this.loading = true;
                this.errors = null;
                try{

                    const response = await axios.post('/register', this.user);

                    if(response === 201){
                        logIn();
                        this.$store.dispatch('loadUser');
                        this.$router.push({name:'home'});
                    }
                } catch (err) {
                    this.errors = err.response && err.response.data.errors;
                    console.log('errors', this.errors);
                }
                this.loading = false;
            }
        }
    }
</script>

<style scoped>

</style>
