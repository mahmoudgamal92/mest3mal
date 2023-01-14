<template>
    <div class="row m-0 chat-both-section">

        <div class="col-sm-12 col-md-4 p-0  chat-left-d">
            <div class="chat-serc">
                <form class="project-filter-form">
                    <input type="search" placeholder="Enter to search">
                    <button class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
            <div class="recet-chat">
                <div class="recet-chat-swticher"> <a class="recet-chat-btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Recent</a>
                    <div class="dropdown-menu" style=""> <a class="dropdown-item" href="#">older chat</a> <a class="dropdown-item" href="#">new chat</a> </div>
                </div>
            </div>
            <div class="chat-holders">
                <ul class="all-chats custom-scrollbar-css-h">
                    <li style="padding-bottom: 20px;" v-for="friend in users"  :key="friend.id" v-if="user.id!=friend.id" @click="activeFriend=friend.id">
                        <div v-if="friend.image === null">
                            <img src="/orbscope/orbscope.jpg" />
                        </div>
                        <div v-else>
                            <img v-bind:src="'/uploads/' + friend.image" />
                        </div>
                        <h3 class="chat-holder-name">{{friend.name}}</h3>
                        <p class="chat-holder-msg">{{friend.sub_title}}</p>
                        <span  class="chat-time">Offline</span>
                    </li>

                </ul>
            </div>
        </div>
        <div class="col-sm-12 col-md-8 p-0  chat-right-d">
            <div class="right-chat-history">
                <div class="chat-with-user">

                    <div v-if="username === null"></div>
                    <div v-else>
                        <div  class="user-p" style="padding-bottom: 20px;">
                            <div v-if="username.image === null">
                                <img src="/orbscope/orbscope.jpg" />
                            </div>
                            <div v-else>
                                <img v-bind:src="'/uploads/' + username.image" />
                            </div>
                            <h3  class="chat-holder-name">{{username.name}}</h3>
                            <!--
                             <p class="chat-holder-msg">Offline <i class="fa fa-circle" aria-hidden="true"></i> Last seen 3 hours ago</p>
                             -->
                        </div>
                    </div>
                    <div id="chating_div" class="chat-mag-user" style="overflow:auto;">
                        <ul>
                            <li  v-for="(item,index) in allMessages" :key="index" :class="(user.id == item.user_id)?'left-align-chat chat-bx':'right-align-chat chat-bx'">
                                <span class="white-chat"><p>{{item.message}}</p></span>
                                <small class="msg-time">{{item.created_at}}</small>
                            </li>


                        </ul>

                    </div>
                    <div class="chat-btm-typing">
                        <form v-on:submit.prevent>
                            <textarea rows="1" v-model="message"  placeholder="Type a message here…"></textarea>
                            <i class="fa fa-paperclip" aria-hidden="true"></i>
                            <button @click="sendMessage" class="btn green-btn"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>

                            <span class="icon-on-textarea">
                          <i class="fa fa-smile-o" aria-hidden="true"></i>
                          <i class="fa fa-microphone" aria-hidden="true"></i>
                      </span>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        props:['user'],

        data(){
            return{
                message:null,
                username:null,
                activeFriend:null,
                allMessages:[],
                users:[]
            }
        },
        watch:{
            activeFriend(val){
                this.fetchMessages();
            },
        },
        methods:{
            sendMessage(){

                if(!this.message){
                    return alert('Please enter message');
                }
                if(!this.activeFriend){
                    return alert('Please select user');
                }
                // this.allMessages.push(this.message);

                //send post message
                axios.post('/private_messages/'+this.activeFriend,{message:this.message}).then(response =>{

                    this.message=null;
                    this.fetchMessages();
                    setTimeout(this.scrollToEnd(),100);
                });

            },

            fetchMessages(){

                axios.get('/private_messages/'+this.activeFriend).then(response =>{

                    this.allMessages=response.data.data;
                    this.username=response.data.user;
                    setTimeout(this.scrollToEnd,100);
                })
            },
            fetchUsers(){
                axios.get('/users/chating').then(response =>{

                    this.users=response.data;
                })
            },

            scrollToEnd(){

                var container = this.$el.querySelector("#chating_div");
                container.scrollTop = container.scrollHeight;
            }
        },

        mounted(){



        },

        created(){

            this.fetchMessages();
            this.fetchUsers();

            Echo.private('privatechat.'+this.user.id).listen('PrivateMessageSent',(e)=>{
                this.allMessages.push(e.message)
                setTimeout(this.scrollToEnd(),100);
            })
        }

    }
</script>