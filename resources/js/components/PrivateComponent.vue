<template>
    <div class="row m-0 chat-both-section">

    <div class="col-sm-12 col-md-4 p-0  chat-left-d">
        <div class="chat-serc">
            <form class="project-filter-form" >
                <input  name="name" placeholder=" " v-model="search"  style="border: 1px solid #ddd;border-radius: 5px;">
                <button  class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>
        </div>
        <div class="chat-holders">
            <ul class="all-chats custom-scrollbar-css-h">
                <li style="padding-bottom: 20px;" v-for="friend in filteredList"  :key="friend.id"  @click="activeFriend=friend.id">
                    <div v-if="friend.image === null">
                        <img src="/orbscope/orbscope.jpg" />
                      </div>
                    <div v-else>
                        <img v-bind:src="'/uploads/' + friend.image" />
                      </div>
                    <h3 class="chat-holder-name">{{friend.name}}</h3>
                    <p class="chat-holder-msg">{{friend.sub_title}}</p>
                    <span style="color: #64bd88;" v-if="onlineFriends.find(onlineFriend=>onlineFriend.id===friend.id)" class="chat-time">online</span>
                    <span v-else class="chat-time">offline</span>
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

                      <p  v-if="onlineFriends.find(onlineFriend=>onlineFriend.id===username.id)" style="color: #64bd88;" class="chat-holder-msg">online </p>
                      <p v-else  class="chat-holder-msg">offline</p>

                </div>
                </div>
                <div id="chating_div" class="chat-mag-user" style="overflow:auto;">
                    <ul>
                        <li  v-for="(item,index) in allMessages" :key="index" :class="(user.id == item.user_id)?'left-align-chat chat-bx':'right-align-chat chat-bx'">
                            <span v-if="item.message" :class="(user.id == item.user_id)?'white-chat':'green-chat'"><p>{{item.message}}</p></span>
                            <span v-else-if="item.image" class="image-container">
                                <div v-if="item.image.substr(item.image.lastIndexOf('.') + 1)=='png'">
                                     <img  :src="'/uploads/'+item.image"/>
                                </div>
                                <div v-else-if="item.image.substr(item.image.lastIndexOf('.') + 1)=='jpeg'" >
                                     <img  :src="'/uploads/'+item.image"/>
                                </div>
                                <div v-else-if="item.image.substr(item.image.lastIndexOf('.') + 1)=='jpg'" >
                                     <img  :src="'/uploads/'+item.image"/>
                                </div>
                               <div v-else-if="item.image.substr(item.image.lastIndexOf('.') + 1)=='docx'" >
                                     <a v-bind:href="'uploads/'+item.image">{{item.image}}</a>
                                </div>
                                <div v-else-if="item.image.substr(item.image.lastIndexOf('.') + 1)=='doc'" >
                                     <a v-bind:href="'uploads/'+item.image">{{item.image}}</a>
                                </div>
                                <div v-else-if="item.image.substr(item.image.lastIndexOf('.') + 1)=='pdf'" >
                                     <a v-bind:href="'uploads/'+item.image">{{item.image}}</a>
                                </div>
                                <div v-else >
                                     <a v-bind:href="'uploads/'+item.image">{{item.image}}</a>
                                </div>
                                </span>

                            <small class="msg-time">{{item.created_at}}</small>
                        </li>


                    </ul>

                </div>
                <div class="chat-btm-typing">
                    <form v-on:submit.prevent >
                        <div class="col-12 col-sm-12">
                        <div class="row">
                        <div class="col-md-9">
                        <textarea  class="textatt" rows="1" v-model="message"  placeholder="Type a message here…"></textarea>
                        </div>
                        <div class="col-md-1" style="width: 10%;">
                        <file-upload
                                :post-action="'/private_messages/'+activeFriend"
                                ref='upload'
                                v-model="files"
                                @input-file="$refs.upload.active = true"
                                :headers="{'X-CSRF-TOKEN': token}"
                                style="position: revert;" >
                            <i class="fa fa-paperclip fa-lg" aria-hidden="true"></i>
                        </file-upload>
                        </div>
                        <div class="col-md-2"  >
                        <button @click="sendMessage" class="btn green-btn"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>

                        </div>
                        </div>
                        </div>
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
                files:[],
                search: '',
                username:null,
                activeFriend:null,
                onlineFriends:[],
                allMessages:[],
                users:[],
                token:document.head.querySelector('meta[name="csrf-token"]').content
            }
        },
        computed:{
            friends(){

                return this.users.filter(user=>{

                    return user.id !==this.user.id;
                })
            },
            filteredList() {
                return this.friends.filter(post => {
                    return post.name.toLowerCase().includes(this.search.toLowerCase())
                })
            }

        },
        watch:{
            files:{
                deep:true,
                handler(){
                    let success=this.files[0].success;
                    if(success){
                        this.fetchMessages();
                    }
                }
            },
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
                    this.activeFriend=this.friends[0].id;

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

            Echo.join('plchat')
                .here((users) => {
                    this.onlineFriends=users;

                })
                .joining((user) => {
                    this.onlineFriends.push(user);
                })
                .leaving((user) => {
                    this.onlineFriends.splice(this.onlineFriends.indexOf(user),1);
                    console.log('leaving',user.name);
                });

            Echo.private('privatechat.'+this.user.id).listen('PrivateMessageSent',(e)=>{
                this.allMessages.push(e.message)
                setTimeout(this.scrollToEnd(),100);
            })
        }

    }
</script>

<style scoped>



    .textatt {
        width: inherit
    }
    @media  (max-width: 600px) {
        .textatt{
            width:80%;
        }
    }
</style>