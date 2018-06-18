<template>
    <div>
        <div class="body">
            <p class="text-center" v-if="loading" style="color: #0000F0">
                loading ...........
            </p>
            <p class="text-center" v-if="!loading">
             <button class="btn btn-primary" v-if="status==0" @click="addFriend">Add Friend</button>
                 <span class="text-success" v-if="status=='waiting'">Friend Request Sent</span>
                <span class="text-success" v-if="status=='blocked'">Friend has been blocked</span><br>
                <button class="btn btn-success" @click="unblockFriend" v-if="status=='blocked'">Unblock</button>
                <span class="text-success" v-if="status=='removed'">You are no longer friends Now</span>
            </p>


                <p v-if="!loading" class="text-center" >
                    <button v-if="status=='friends'" @click="removeFriend" class="btn btn-warning fa fa-close"> Remove</button>
                    <button  v-if="status=='friends'" @click="blockFriend"class="btn btn-warning fa fa-ban"> Block</button>
                </p>
            <p v-if="!loading" class="text-center" >
                <button class="btn btn-success" v-if="status=='pending'" @click="acceptFriend">Accept</button>
                <button v-if="status=='pending'" @click="denyFriend" class="btn btn-danger">Deny</button>
                <button  v-if="status=='pending'" @click="blockFriend"class="btn btn-danger">Block</button>
            </p>

        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
           this.$http.get('/check_status/'+this.profile_user_id).then((response)=>{
                   console.log(response)
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
        },
        methods:
            {
                addFriend(){
                    this.loading=true
                    this.$http.get('/addFriend/'+this.profile_user_id).then((response)=>{
                        if(response.body==1){
                            this.status='waiting'
                            this.loading=false
                        }
                    })
                },
                acceptFriend(){
                    this.loading=true
                    this.$http.get('/acceptFriend/'+this.profile_user_id).then((response)=>{
                        if(response.body==1){
                            this.status='friends',
                            this.loading=false
                        }
                    })
                },
                removeFriend(){
                    this.loading=true
                    this.$http.get('/removeFriend/'+this.profile_user_id).then((response)=>{
                        if(response.body==1){
                            this.status='removed'
                            this.loading=false
                        }
                    })
                },
                blockFriend(){
                this.loading=true
                this.$http.get('/blockFriend/'+this.profile_user_id).then((response)=>{
                    if(response.body==1){
                        this.status='blocked'
                        this.loading=false
                    }
                })
            }, denyFriend(){
                    this.loading=true
                    this.$http.get('/blockFriend/'+this.profile_user_id).then((response)=>{
                        if(response.body==1){
                            this.status='denied'
                            this.loading=false
                        }
                    })
                },
                unblockFriend(){
                    this.loading=true
                    this.$http.get('/unblockFriend/'+this.profile_user_id).then((response)=>{
                        if(response.body==1){
                            this.status='friends'
                            this.loading=false
                        }
                    })
                }
            }
    }
</script>
