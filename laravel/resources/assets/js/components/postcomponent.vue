<template>
    <div  class="panel-body">
        <div class="panel-info">
            <form  v-if="addpost" @submit.prevent="savePost">
                <div class="form-group">
                    <textarea v-model="body" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Post a Story</button>
                </div>
            </form>
        </div>
        <div v-if="noActivity">

            <h4>No Activities Create a Post</h4>
        </div>
        <div class="container">
            <div  v-for="singleFeed  in feed" class="panel-body">
                <div class="col-lg-1">
                  <p class="text-justify">{{singleFeed.body}}</p>
                   <p class="pull-left">{singleFeed.created_at}}</p>
                </div>
                <div v-if="profile_user_id==singleFeed.user_id" >
                 <button @click="deletePost(singleFeed.id)" class="btn btn-danger">Delete post</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        mounted(){
            this.$http.get('post/get').then((response)=>{
                if(response.posts.length==0) {
                    this.noActivity=true;
                }
                response.posts.forEach((post) => {
                    this.feed.push(post);
                });
            })
        },
        props: ['profile_user_id']
        ,
        data(){
            return{
                addpost: true,
                body: '',
                posts: [],
                feed: [],
                noActivity: false
            }
        },
        methods:{
            savePost: function () {
                this.addpost=false;
                this.addpost=false;
                let postData = {
                    body: this.body,
                }
                this.$http.post('post/save', postData).then(
                    (response) => {
                           
                    }
                )
            },
            deletePost: function ($id) {
                this.$http.get('post/delete/' + $id).then(
                    (resonse)=>{

                    }
                )
            }
        }
    }
</script>