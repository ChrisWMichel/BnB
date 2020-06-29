<template>

    <div>
        <div
            class="invalid-feedback"
            v-for="error in errors"
            :key="key()"
        >
            {{error}}
        </div>
    </div>
</template>

<script>
    export default {
        name: "ValidationErrors",
        props: ['errors'],
        methods:{
            key(){
                return `validation_error_${Math.random()}`;
            }
        }
    }
</script>

<style scoped>
    .form-control.is-invalid ~ div > .invalid-feedback{
        display: block;
        border-color: #b22222;
        background-image: none;
    }
    .invalid-feedback{
        color: #b22222;
        display: block;
    }
</style>
