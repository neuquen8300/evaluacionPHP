<template>
  <section class='login'>
      <form class='login-form' @submit.prevent='login()'>
        <div class="input-wrapper">
          <label for="username" aria-label="username">Usuario o Email:</label>
          <vue-text-input 
            name="username" 
            id="form-username" 
            placeholder="Usuario o Email..." 
            aria-placeholder="Usuario o Email" 
            required 
            v-model="username"
            @input="errorDismiss('form-username')"/>
        </div>
        <div class="input-wrapper">
          <label for="password" aria-label="password">Contraseña:</label>
          <vue-password-input 
            type="password" 
            name="password" 
            id="form-password" 
            placeholder="Contraseña..." 
            aria-placeholder="Contraseña" 
            required 
            v-model="password"
            @input="errorDismiss('form-password')"/>
        </div>
        <div class="input-wrapper submit">
            <div class="message-box" v-if='loginError'>
                {{loginMessage}}
            </div>
            <vue-button type='submit' buttonText='INGRESAR' btnEvent='next-step' ></vue-button>
        </div>
      </form>
  </section>
</template>

<script>
export default {
    name: 'login',
    data() {
        return {
            username: '',
            password: '',
            loginError: false,
            loginMessage: ''
        }
    },
    methods: {
        login: function(){
            console.log('hola login');
            if(this.$data.username.length > 0 && this.$data.password.length > 0){
                // fetch(...)
            } else if (this.$data.username.length === 0){
                this.setLoginError('form-username');
            } else if (this.$data.password.length === 0){
                this.setLoginError('form-password');
            }
        },
        setLoginError: function(formInput){
            console.log('hola')
            document.getElementById(formInput).classList.add('error');
            this.$data.loginError = true;
            this.$data.loginMessage = 'Faltan completar los campos en rojo';
        },
        errorDismiss(formInput){
            document.getElementById(formInput).classList.remove('error');
        }
    }
}
</script>

<style scoped>
    .login{
        background-color: #bbbbff;
        width: 40vw;
        margin: 0 auto;
        display: flex;
        padding:  0 1rem;
        border-radius: 2px;
    }
    .input-wrapper{
        margin-top: 1rem;
        margin-bottom: 1rem;
    }
    .login-form, .input-wrapper, .input-wrapper label{
        width: 100%;
    }
    
    .input-wrapper.submit{
        display: flex;
        text-align: right;
    }
</style>