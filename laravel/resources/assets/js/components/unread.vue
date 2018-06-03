<template>
    <span v-if="loaded" style="color: blue;">({{count}})</span>
</template>
<script>
    export default {
        mounted(){
            this.loaded=false;
            console.log(this.user_id);
            this.$http.get('/fetchUnread/'+this.user_id).then((response)=>{
                console.log(response);
                this.count=response.body;
                this.loaded=true;

         })
        },
        props: ['user_id']
        ,
        data(){
            return{
                count: 0,
                loaded: false
            }
        }
    }
</script>
