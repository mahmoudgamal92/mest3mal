<template>
    <div  class="header-notification"><span style="color: #6ab04c;padding: 0.2em 0.1em;font-size: 85%;" class="badge badge-light">{{unreadNotifications.length}}</span>
        <button @click="markNotificationAsRead" class="header-notification-btn dropdown-toggle arrow-hide" data-toggle="dropdown"><i class="fa fa-bell" aria-hidden="true"></i></button>
        <div style="overflow: auto;height: 360px;" class="dropdown-menu" >
            <div class="requests-type">
                <ul>

                    <notification-item v-for="unread in unreadNotifications" :unread="unread" :key="unread.id" :language="language" ></notification-item>

               </ul>
            </div>

        </div>
    </div>
</template>

<script>
    import NotificationItem  from './NotificationItem.vue';
    export default {
        props: ['unreads', 'userid','lang'],
        components: {NotificationItem},
        data(){
          return{
              unreadNotifications:this.unreads,
              language:this.lang,

          }
        },
        methods:{
            markNotificationAsRead() {
                if (this.unreadNotifications.length) {
                    axios.get('/markAsRead');
                }
            }
        },
        mounted() {
            console.log('Component mounted.');

            Echo.private('App.User.'+ this.userid)
                .notification((notification) => {
                    //console.log(notification);
                    let newUnreadNotifications = {data: {freelancer: notification.freelancer,project:notification.project,image:notification.image,ar:notification.ar,en:notification.en,date:notification.date,url:notification.url}};
                    this.unreadNotifications.push(newUnreadNotifications);

                });
        }
    }
</script>
