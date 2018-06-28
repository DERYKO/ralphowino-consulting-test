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
        <div class="panel panel-default">
            <div class="panel-body">
                <div  v-for="singleFeed  in feed" class="panel-body">
                    <h5> <p class="text-center">{{singleFeed.activity.actor}}</p></h5>
                    <p class="text-center"><img src="/storage/avatar/female.png" alt="No Profile" height="50px" width="50px" style="border-radius: 50%;"/></p>
                    <p class="text-center">{{singleFeed.activity.tweet}}</p>
                    <p class="text-center">{{singleFeed.activity.time}}</p>
                    <p class="text-center"><button v-if="singleFeed.activity.object==profile_user_id" class="btn btn-primary" @click="deletePost(singleFeed.post.id)"> Delete</button></p>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
    export default {
        mounted(){
            console.log(123);

        },
        created(){
            this.fetchFeed();
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
            },
            fetchFeed: function () {
                console.log('ok');
                this.$http.get('/post/get').then((feed)=>{
                    console.log(feed.body.posts);
                    if(feed.body.posts.length === 0) {
                        this.noActivity =true;
                    }
                    feed.body.posts.forEach((post) => {
                        this.feed.push(post);
                    });

                })
            }
        }
    }
</script>