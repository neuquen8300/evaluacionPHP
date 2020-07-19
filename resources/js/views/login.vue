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
            @textInput='usernameModel'
            />
        </div>
        <div class="input-wrapper">
          <label for="password" aria-label="password">Contraseña:</label>
          <vue-password-input
            name="password" 
            id="form-password" 
            placeholder="Contraseña..." 
            aria-placeholder="Contraseña" 
            required 
            @passwordInput='pwModel'
            />
        </div>
        <div class="input-wrapper submit">
            <div class="message-box" v-if='loginError'>
                {{loginMessage}}
            </div>
        <vue-button class='submit-button' type='submit' buttonText='INGRESAR' btnEvent='next-step' ></vue-button>
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
            if(this.$data.username.length > 0 && this.$data.password.length > 0){
                let formData = new FormData;
                formData.append('username', this.$data.username);
                formData.append('password', this.$data.password);
                //
                fetch(process.env.MIX_APP_URL + '/api/login', { // Ver MIX_APP_URL en archivo .env
                    method: 'POST',
                    body: formData,

                })
                .then(res => {
                    return res.json();
                })
                .then(data => {
                    console.log(data);
                })
                .catch(e => {
                    console.log(e);
                })
            } else if (this.$data.username.length === 0){
                this.setLoginError('form-username');
            } else if (this.$data.password.length === 0){
                this.setLoginError('form-password');
            }
        },
        usernameModel: function(model){
            this.$data.username = model;
        },
        pwModel: function(model){
            this.$data.password = model;
        },
        setLoginError: function(formInput){
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
        width: calc(100vw - 2rem);
        max-width: 30rem;
        margin: 1rem;
        display: flex;
        border-radius: 2px;
    }
    .input-wrapper{
        margin-top: 1rem;
        margin-bottom: 1rem;
    }
    .login-form{
        padding: 0 1rem;
    }
    .login-form, .input-wrapper{
        width: 100%;
    }
    
    .input-wrapper.submit{
        display: flex;
        justify-content: center;
    }
    @media screen and (min-width: 30rem){
        .login{
            margin-right: auto;
            margin-left: auto;
        }
    }
    
</style>