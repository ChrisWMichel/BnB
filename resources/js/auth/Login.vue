<template>
    <div class="w-50 m-auto">

        <div class="card card-body">
            <form>
                <div class="form-group">
<!--                    <label for="email">Email</label>-->
                    <input
                        type="text"
                        name="email" id="email"
                        placeholder="Email"
                        class="form-control"
                        v-model="email"
                        :class="[{'is-invalid': errorFor('email')}]"
                    >
                    <validation-errors :errors="errorFor('email')"></validation-errors>
                </div>
                <div class="form-group">
<!--                    <label for="password">Password</label>-->
                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Password"
                        class="form-control"
                        v-model="password"
                        :class="[{'is-invalid': errorFor('password')}]"
                    >
                    <validation-errors :errors="errorFor('password')"></validation-errors>
                </div>

                <button type="submit" class="btn btn-primary btn-lg btn-block" :disabled="loading" @click.prevent="login">Login</button>

                <hr/>

                <div>
                    No account yet?
                    <router-link :to="{name:'register'}" class="font-weight-bold">Register</router-link>
                </div>
                <br>
                <div>
                    <router-link :to="{name:'home'}" class="font-weight-bold">Forgot password</router-link>
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
                email:null,
                password:null,
                loading:false
            }
        },
        methods:{
            async login(){
                this.loading = true;
                this.errors = null;
                try{
                    await axios.get('/sanctum/csrf-cookie');
                    await axios.post('/login', {
                        email: this.email,
                        password: this.password
                    });
                    logIn();

                    this.$store.dispatch('loadUser');
                    this.$router.push({name:'home'});
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
