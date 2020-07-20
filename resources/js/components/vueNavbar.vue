<template>
  <nav class='navbar'>
      <ul class='navbar-list'>
        <li><router-link to='/'>INICIO</router-link></li>
        <li v-if='!logged'><router-link to='login'>LOGIN</router-link></li>
        <li v-if="logged"><router-link to='profile'>PERFIL</router-link></li>
        <li v-if='logged' @click='logout'>SALIR</li>
      </ul>
  </nav>
</template>

<script>
import eventBus from '../eventBus';

export default {
    name: 'vue-navbar',
    data() {
        return {
            logged: false
        }
    },
    mounted() {
        eventBus.$on('isLogged', () => {
            this.isLogged();
        })
    },
    methods: {
        isLogged: function(){
            if (sessionStorage.getItem('access_token')){
             this.$data.logged = true;   
            } else {
                this.$data.logged = false;
            }
        },
        logout: function(){
            fetch(process.env.MIX_APP_URL + '/api/logout', {
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + sessionStorage.getItem('access_token')
                }
            })
            .then(res => {
                return res.json();
            })
            .then(data => {
                if (data.status) {
                    sessionStorage.clear();
                    this.$router.push({path: '/'});
                }
            })
            .catch(e => {
                return e;
            })
        }
    },

    
}
</script>

<style scoped>
.navbar{
    padding: 1rem;
    width: calc(100vw - 2rem);
    height: 2rem;
    text-align: right;
    display: flex;
}
.navbar-list{
    width: 100%;
    margin: auto 0;
    padding-left: 0;
    height: fit-content;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
li{
    display: inline-flex;
    list-style-type: none;
}
</style>