<template>

  <v-form
  class="display-1 my-10"
    ref="form"
    lazy-validation
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
      color="success"
      class="mr-4"
      @click="login"
    >
      Validate
    </v-btn>

    <v-btn
      color="error"
      class="mr-4"
    >
      Reset Form
    </v-btn>

  </v-form>
</template>

<script>
export default {
  data () {
    return {
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
          console.log(err)
        })
    }
  }
}
</script>
