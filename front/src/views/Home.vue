<template>
       <v-container fluid>
              <v-data-iterator
              :items="items"
               hide-default-footer hide-default-header
               >
                <template v-slot:default="props">
                    <v-row>
                        <v-col v-for="book in props.items" :key="book.id" cols="4">
                            <v-card >
                                <v-img max-height="150" contain :src="book.cover"/>
                                <v-divider></v-divider>
                                <v-card-title>
                                    <router-link :to="'/books/'+book.id">{{book.title}}</router-link>
                                </v-card-title>
                                <v-card-subtitle>{{book.created_at.slice(0,10)}}</v-card-subtitle>
                            </v-card>
                        </v-col>
                    </v-row>
                </template>
              </v-data-iterator>
       </v-container>
</template>

<script>
import axios from 'axios'
export default {
       data(){
              return{
                     items:[]
              }
       },
       mounted(){
              axios.get('/post')
              .then(response=>{
                     console.log(response.data)
                     this.items=response.data
              })
       }
}
</script>