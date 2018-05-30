<template>
    <div>
        <div class="body">
          hello
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.$http.get('/check_status/'+this.profile_user_id).then((response)=>{
                console.log(response);
                this.status=response.body.status,
                    this.loading=false
            })
        },
        props: ['profile_user_id'],
        data(){
            return{
                status: '',
                loading: true
            }
        }

    }
</script>