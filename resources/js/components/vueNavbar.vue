<template>
  <nav class='navbar'>
      <li v-if='!isLogged'><router-link to='login'>LOGIN</router-link></li>
      <li v-else><router-link to='logout'>SALIR</router-link></li>
  </nav>
</template>

<script>
export default {
    name: 'vue-navbar',
    data() {
        return {
            isLogged: false
        }
    },
    mounted() {

    }
}
</script>

<style scoped>
.navbar{
    padding: 1rem;
    width: calc(100vw - 2rem);
    height: 2rem;
    text-align: right;
}
li{
    list-style-type: none;
}
</style>