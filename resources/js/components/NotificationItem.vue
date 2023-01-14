<template>
    <li><a :href="threadUrl"><div style="display: grid;font-size: 11px;"  class="bid-descriptions">
        <span v-if="unread.data.image != null" style="top: 0px;" class="file-icons">
        <img style="width: 60px;" v-bind:src="'/uploads/' + unread.data.image"></span>
        <span v-else style="top: 0px;" class="file-icons">
            <img  style="width: 60px;" src="/orbscope/orbscope.jpg" />
        </span>
        <h4 class="bid-title">{{unread.data.freelancer}}</h4>
        <span v-if="language=='ar'" >{{unread.data.ar}}</span>
        <span v-else>{{unread.data.en}}</span>
        <p  class="bid-descrip">{{unread.data.project}}</p>
        <div class="pop-shed"> <!--<span class="poc">USD $450 - $894</span> --><span class="float-right">{{ unread.data.date | moment("from", "now") }}</span></div>
    </div></a></li>

</template>

<script>
    import moment from 'moment';
    export default {
        props:['unread','language'],
        data(){
            return {
                threadUrl:""
            }
        },
        mounted() {

            this.threadUrl="/"+ this.unread.data.url
        }
    }
</script>
