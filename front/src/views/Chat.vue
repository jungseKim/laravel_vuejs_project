<template>
    <div >
        <v-app>
            <v-container>
                <v-row>
                    <v-col>
                    <ChatUserList
                    :chatWith='chatWith'
                        @updatedChatWith="updateChatWith"
                          />
                    </v-col>
                    <v-col>
                        <div v-if="chatWith" >
                            <ChatArea 
                                :chat-id="chatWith"
                                :messages="messages"
                                />
                            <div class="flex-initial p-2">
                            <v-text-field
                                    type="text"
                                         label="text input"
                                    v-model="text"
                                    @keyup.enter="submit"
                                >this is text </v-text-field>
                            </div>
                        </div>
        <div v-else class="p-3">
            채팅 상대를 선택해주세요
        </div>
        </v-col>
        </v-row>
        </v-container>
        </v-app>
    </div>
</template>

<script>
    import axios from 'axios'
    import ChatUserList from './ChatUserList';
    import ChatArea from './ChatArea';
    import Pusher from 'pusher-js';
    export default {
        components: {
            ChatUserList,
            ChatArea
        },
        data() {
            return {
                chatWith: null,
                text:null,
                messages:[],
                crrunt:this.$store.state.user.user.id
                      
            }
        }
        ,
        mounted() {
            Pusher.logToConsole = true;
                const pusher = new Pusher('09b388928591241646f6', {
               cluster: 'ap3',
             });
           const channel = pusher.subscribe('chat'+this.crrunt);
      channel.bind('App\\Events\\MessageSent', e=>{
          if(e.message.to===this.crrunt)
            this.messages.push(e.message);
       
      });
    }
        ,
        methods: {
            updateChatWith(value) {
                this.chatWith = value;
                  this.getMessages();
            }
            ,
              getMessages() {
                axios.get('/messages', {
                    params: {
                        to: this.chatWith,
                    }
                }).then(res => {
                    console.log(res.data.crrunt);
                    // this.crrunt=res.data.crrunt;
                   this.messages = res.data.messages;
                })
            }
            ,  submit() {
                if (this.text) {
                    axios.post('/messages', {
                        text: this.text,
                        to: this.chatWith,
                    }).then(response=>{
                        this.messages.push(response.data.message);
                    }).catch(err=>{
                        console.log(err.data);
                    });
                }
                   
                    this.text='';
        }
        }
    }
</script>

<style>
</style>