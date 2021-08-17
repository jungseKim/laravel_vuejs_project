<template>
    <div class="flex h-full">
        <ChatUserList
            @updatedChatWith="updateChatWith"
        />

        <div v-if="chatWith" >
            <ChatArea />
            <div class="flex-initial p-2">
                <input type="text">
            </div>
        </div>
        <div v-else class="p-3">
            채팅 상대를 선택해주세요
        </div>
    </div>
</template>

<script>

    import ChatUserList from './ChatUserList';
    import ChatArea from './ChatArea';
    export default {
        components: {
            ChatUserList,
            ChatArea
        },
        data() {
            return {
                chatWith: null,
            }
        },
        mounted() {
            console.log('Component mounted.')

        },
        methods: {
            updateChatWith(value) {
                this.chatWith = value;
            }
        }
    }
</script>

<style>
</style>