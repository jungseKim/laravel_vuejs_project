<template>
<v-container>
       <v-text-field
              v-model="title"
              class="mt-12"
              color="purple darken-2"
              label="title"
              required
            ></v-text-field>
        <v-textarea
              class="mb-10"
              color="teal"
              v-model="content"
            >
              <template v-slot:label>
                <div>
                  Content <small>(optional)</small>
                </div>
              </template>
            </v-textarea>
              <v-file-input
              accept="image/*"
              label="File input"
              ></v-file-input>
             <v-layout align-center>
              <v-btn class="center" @click="post">submit</v-btn>
             </v-layout>
</v-container>
</template>

<script>
import axios from 'axios'
export default {
       data(){
              return{
                     title:'',
                     content:''
                     
              }
       },
       methods:{
              post(){
                     axios.post('/posts',{
                            user_id:this.$store.state.user.user.id,
                            title:this.title,
                            content:this.content,

                     }).then(response=>{
                            console.log(response.status)
                     }).catch(err=>{
                            console.log(err)
                     })
                     
              }
       },
       mounted(){
              console.log(this.$store.state.user)
              console.log(this.$store.state.user.token)
       }
}
</script>