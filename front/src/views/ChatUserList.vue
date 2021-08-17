<template>
    <div class="w-1/5 border-r-2 border-solid border-gray-600">
        <div
            v-for="user in usersWithoutSignedInUser"
            :key="user.id"
            class="p-2 border-b-2 border-gray-600 hover:bg-gray-300 cursor-pointer"
            @click="updateChatWith(user.id)"
        >
            {{ user.name }}
        </div>
    </div>
</template>

<script>
import axios from 'axios'
    export default {
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