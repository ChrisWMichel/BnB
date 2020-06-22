<template>
    <div>
        <h1>Bookables</h1>
        <div v-if="loading">Data is loading...</div>
        <div v-else>

            <div v-for="row in rows" :key="'row' + row" class="row mb-4">
                <div v-for="(book, col) in bookablesInRow(row)" :key="'col' + col" class="col">
                    <list-item
                        :title="book.title"
                        :content="book.description"
                        :price="book.price"

                    ></list-item>
                </div>
                <div class="col" v-for="p in placeholdersInRow(row)" :key="'placeholder' + p"></div>
            </div>
        </div>


<!--        <div v-else>There are no rooms for booking</div>-->
    </div>
</template>

<script>
    import ListItem from "./ListItem";
    export default {
        name: "Bookables",
        components: {ListItem},
        data(){
            return {
                bookables:{},
                loading:false,
                columns:3
            }
        },
        computed:{
            rows(){
                return Math.ceil(this.bookables.length/this.columns);
            }
        },
        methods:{
            bookablesInRow(row){
              return  this.bookables.slice((row -1) * this.columns, row * this.columns)
            },
            placeholdersInRow(row){
                return this.columns - this.bookablesInRow(row).length;
            }
        },
        created() {
            this.loading = true;
           /* axios.get('/api/bookables/', 1)
            .then(resp => console.log('resp', resp.data))
            .catch(error => console.log(error.response.data))*/

            axios.get('/api/bookables')
            .then(
                resp => {
                    this.bookables = resp.data
                    this.loading = false;
                }
            )
            .catch(error => console.log(error.response.data));
        }
    }
</script>

<style scoped>

</style>
