 <template>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Chats
                    </div>
                    <div class="panel-body">
                        <div>
                            <div class="form-group form-control-sm">
                                <label for="participants">Select Friends </label>
                                <select v-model="participants" multiple class="form-control" id="participants">
                                    <option v-for="friends in friendsMessages" :value="friends.id"> {{ friends.name }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p class="text-center">My Threads</p>
                    </div>
                    <div v-if="participants.length >= 1" class="panel-body">
                    <p class="text-center" @click="addMessage"><button class="btn btn-success ">New Thread</button></p>
                        <form  v-if="newMessage" @submit.prevent="startThread">
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input v-model="subject" name="subject"  class="form-control" id="subject" type="text"  required/>
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea class="form-control" v-model="message" name="message" id="message" rows="4" placeholder="Send a textMessage"  required>
                                      </textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Send Message</button>
                            </div>
                            <div v-if="threads.length>0" class="col">

                        </div>
                        </form>
                    </div>
                    <div v-if="info" v-for="thread in threads">
                        <div @click="getMessages(thread.id)" class="panel panel-info">
                            <div class="panel-heading">
                                <button @click="getParticipants(thread.id)" class="btn btn-primary btn-sm pull-right">Thread Info</button>
                                <h6 class="text-center" style="color: #7e57c2">@{{ thread.user.name }}</h6>
                            </div>
                            <div class="body">
                                <p class="text-center">Subject: {{thread.subject}}</p>
                                <p class="text-center">Messsage: {{ thread.latest_message.body.substring(0,70) + '...'}}</p>

                            </div>
                        </div>
                    </div>
                    <div v-if="!info">
                        <div class="panel panel-default">
                            <button class="btn-sm fa fa-mail-reply" @click="resetFalse" style="color: #b1b7ba">Back</button>
                            <div class="panel-heading">
                                This chat Messages
                            </div>
                            <div v-for="singleMessage in allmessages" class="panel-body">
                                <p class="text-center" style="color: red">@{{singleMessage.user.slug}}</p>
                               <p class="text-center">{{singleMessage.body}}</p>
                                <p class="pull-left">{{singleMessage.created_at}}</p>
                                <button @click="reloadStatus(singleMessage.id)" class="btn btn-success btn-sm pull-right">New Message</button>
                            </div>
                            <div>
                            </div>
                            <div v-if="addnewmessage" class="panel panel-default">
                              <div class="panel-body">
                               <form @submit.prevent="saveMessage">
                                   <div class="form-group">
                                       <label for="addAmessage">Add Message</label>
                                       <textarea id="addAmessage" v-model="addAmessage" rows="2" cols="1" class="form-control" required></textarea>
                                   </div>
                                   <div class="form-group">
                                       <button type="submit" class="btn btn-success btn-sm">Send</button>
                                   </div>
                               </form>
                              </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div v-if="info" class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <button @click="removeParticipant(thread1.id)" class="btn btn-warning btn-sm pull-right">Quit thread</button>
                        Thread Info
                        <h5 style="text-align: center; text-transform: capitalize; color: #985f0d">{{thread1.subject}}</h5>
                    </div>
                  <div class="panel-body">
                      <h5 style="text-align: center">Participants</h5>
                      <hr>
                      <div v-for="participant in participants1" class="panel-item">
                                      <p class="text-center">
                                          <img src="/images/avatar.png" class="img-fluid rounded-circle"/>
                                      </p>
                                      <p class="text-center">{{ participant.user.name }}</p>
                                  <p class="text-center" style="color: blue">{{ participant.user.email }}</p>
                                  <hr>
                          </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    export default {
        mounted() {
            this.$http.get('/getFriends').then((response)=>{
                console.log(response.data.data);
                this.friendsMessages=response.data;
            }),
                this.$http.get('/fetchthreads/'+this.profile_user_id).then((response)=>{
                    console.log(response.body.data);
                    this.threads=response.body.data;
            })

        },
        data(){
            return{
                friendsMessages: [],
                threads: [],
                clicked: false,
                newMessage: false,
                participants: [],
                message: '',
                subject: '',
                friend_id: 1,
                info: false,
                participants1: [],
                thread1: [],
                info: true,
                allmessages: [],
                addnewmessage: false,
                addAmessage: '',
                passThreadId: 0

            }
        },
        props: ['profile_user_id'],
        methods:
            {
                messages: function ($id) {
                    this.friend_id=$id;
                    this.clicked=true;
                    this.$http.get('/getFriends/'+$id).then((response)=>{
                        this.threads=response.data;
                        console.log(response.data);

                    })
                },
                addMessage: function () {
                    this.newMessage=true;
                },
                startThread: function () {
                    this.newMessage=false;
                    let postData = {
                        message: this.message,
                        participants: this.participants,
                        sender_id: this.profile_user_id,
                        subject: this.subject
                    }
                    this.$http.post('messages/create', postData).then(
                        (data) => {
                            this.threads=data.data;
                        }
                    )
                },
                getParticipants: function ($id) {
                    this.info=true;
                    this.$http.get('messages/thread/participants/'+$id).then(
                        (data) => {
                           console.log(data.body);
                           this.thread1=data.body.thread;
                           this.participants1=data.body.participants;
                        }
                    )
                }
                ,
                removeParticipant: function ($id) {
                    this.$http.get('participant/remove/' +$id).then(
                        (participants) => {
                           this.participants1=participants.data;
                        }
                    )
                 },
                getMessages: function ($id) {
                    console.log($id);
                     this.info=false;
                    this.$http.get('thread/fetchMessages/' +$id).then(
                        (messages) => {
                            this.allmessages=messages.body.data;
                        }
                    )
                },
                resetFalse: function(){
                    this.info=true
                },
                reloadStatus: function ($id) {
                    this.addnewmessage=true;
                    this.passThreadId=$id;
                },
                saveMessage: function ($singleMessage) {
                    this.addnewmessage=false;
                    let postData = {
                        message: this.addAmessage,
                        thread_id: this.passThreadId
                    }
                    this.$http.post('messages/save', postData).then(
                        (messages) => {
                            console.log(messages);
                        }
                    )
                }
            }
    }
</script>