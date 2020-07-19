<template>
  <nav class='navbar'>
      <ul class='navbar-list'>
        <li><router-link to='/'>INICIO</router-link></li>
        <li v-if='!isLogged'><router-link to='login'>LOGIN</router-link></li>
        <li v-else><router-link to='logout'>SALIR</router-link></li>
      </ul>
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
.navbar-list{
    padding-left: 0;
    height: fit-content;
    display: flex;
    justify-content: space-between;

}
li{
    display: inline-flex;
    list-style-type: none;
}
</style>