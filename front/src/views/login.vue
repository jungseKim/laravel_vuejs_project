<template>

  <v-form
  class="display-1 my-10"
    ref="form"
     v-model="valid"
  >
    <v-text-field
      v-model="email"
      label="email"
      required
    ></v-text-field>

    <v-text-field
      v-model="password"
      label="password"
      required
    ></v-text-field>

    <v-btn
    :disabled="!valid"
      color="success"
      class="mr-4"
      @click="login"
    >
      Validate
    </v-btn>

    <v-btn
      color="error"
      class="mr-4"
      @click="register"
    >
      register
    </v-btn>

    <v-btn
      color="error"
      class="mr-4"
      @click="google"
    >
      goole login
    </v-btn>

  </v-form>
</template>

<script>

export default {
  data () {
    return {
      valid:true,
      email: '',
      password: ''
    }
  },

  methods: {
    login () {
      this.$store
        .dispatch('login', {
          email: this.email,
          password: this.password
        })
        .then(() => {
          this.$router.push({ name: 'map' })
        })
        .catch(err => {
          console.log(err.message)
          alert('아이디와 비밀번호를 확인해 주세요')
        })
    },
    register(){
      if(this.$store.state.user){
        return alert('로그 아웃후 이용해 주세요');
      }
      else{
        this.$router.push('register')
      }
    },
   async google(){
    try {
      window.location.href="http://localhost:8000/api/google/login"
      //   const response = await axios.get('http://localhost:8000/sanctum/csrf-cookie')
      // console.log(response.status);
    //  const {data}= await axios.get('/google/login')
      //  this.$store.commit('setUserData', data);
      } catch (err) {
        console.error(err);
      }
    }
  }
}
</script>
