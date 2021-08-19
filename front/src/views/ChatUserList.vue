<template>
    <div class="text-center" justify="center">
        <div
            v-for="user in usersWithoutSignedInUser"
            :key="user.id"
          
            @click="updateChatWith(user.id)"
        >
        <p v-if="user.id==chatWith" class="primary">채팅중: {{ user.name }}</p>
        <p v-else 
           class="teal">{{ user.name }}</p>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
    export default {
        props:{
            chatWith:{
                type:Number,
                required:false
            }
        },
        computed: {
            usersWithoutSignedInUser() {
                return this.users.filter(user => {
                    return user.id !== this.currentUser
                });
            }
        },
        data() {
            return {
                users: [],
                currentUser:null
            }
        },
        created() {
            axios.get('/index').then(res => {
                this.users = res.data.users;
                console.log(res.data.currentUser);
                this.currentUser=res.data.currentUser.id;
            }).catch(error => {
                console.log(error)
            });
        },
        methods: {
            updateChatWith(userId) {
                this.$emit('updatedChatWith', userId);
            }
        }
    }
</script>