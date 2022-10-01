<template>
<div>
    <router-link to="/another">TestNoLoad</router-link>
    <ul class="group-data">
        <li class="data-item" v-for="index in mydata">{{index}}</li>
    </ul>
</div>
</template>

<script>
    export default {
        props:['mydata'],
        data() {
            return {
                msg:this.mydata,
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
    }
</script>
