<template>
    <div class="row m-0 chat-both-section">

        <div class="col-lg-4 chat chat-names pr-lg-0">
            <div class="card mb-sm-3 mb-md-0 contacts_card">
            <div class="card-header p-2">
                <form class="project-filter-form" >
                    <input  name="name" placeholder=" " v-model="search"  style="border: 1px solid #ddd;border-radius: 5px;">
                    <button  class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
            <div class="card-body contacts_body">
                <ul class="contacts">
                    <li v-for="friend in filteredList"  :key="friend.id"  @click="activeFriend=friend.id" style="padding: 5px;margin: 5px;cursor: pointer;">
                        <div class="d-flex bd-highlight">
                            <div v-if="friend.image === null" class="img_cont">
                                <img src="/orbscope/orbscope.jpg" class="rounded-circle user_img smal_img">
                            </div>
                            <div v-else class="img_cont">
                                <img class="rounded-circle user_img smal_img" v-bind:src="'/uploads/' + friend.image" />
                            </div>
                            <div class="user_info w-100">
                              <span> {{friend.name}}

                                   <span  v-if="onlineFriends.find(onlineFriend=>onlineFriend.id===friend.id)" class="user_info_date float-right">online</span>
                        <span v-else class="user_info_date float-right">offline</span>
                              </span>

                            </div>
                        </div>
                    </li>

                </ul>
            </div>
            </div>
        </div>
        <div class="col-lg-8 chat chat-messages pl-lg-0">
            <div class="card">


                    <div v-if="username === null"></div>

                    <div v-else>
                        <div  class="card-header msg_head">


                            <div class="d-flex bd-highlight">
                                <div class="img_cont" v-if="username.image === null">
                                    <img class="rounded-circle user_img smal_img"  src="/orbscope/orbscope.jpg" />
                                </div>
                                <div class="img_cont" v-else>
                                    <img class="rounded-circle user_img smal_img"  v-bind:src="'/uploads/' + username.image" />
                                </div>

                                <div class="user_info">
                                    <h3  class="chat-holder-name">{{username.name}}</h3>
                                    <p  v-if="onlineFriends.find(onlineFriend=>onlineFriend.id===username.id)" style="color: #64bd88;" class="chat-holder-msg">online </p>
                                    <p v-else  class="chat-holder-msg">offline</p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div id="chating_div" class="card-body msg_card_body" style="overflow: auto;height:350px;">
                        <ul>
                            <li  v-for="(item,index) in allMessages" :key="index" :class="(user.id == item.user_id)?'left-align-chat chat-bx':'right-align-chat chat-bx'">
                                <span v-if="item.message" :class="(user.id == item.user_id)?'msg_cotainer':'msg_cotainer_send'"><p>{{item.message}}</p></span>
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

                                <!--

                                <p class="msg_time ml-4">{{item.created_at}}</p>-->
                            </li>


                        </ul>

                    </div>
                    <hr/>


                        <form v-on:submit.prevent >
                            <div class="card-footer">
                                <div class="input-group">

                                        <input  class="form-control type_msg"  v-model="message"  placeholder="اكتب رسالتك">
                                    <div class="input-group-append">
                                        <button @click="sendMessage" class="input-group-text send_btn btn submit-btn"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>

                                    </div>
                                    </div>

                                </div>
                        </form>




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