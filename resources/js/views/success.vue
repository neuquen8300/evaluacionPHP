<template>
  <div class="success-msg">
      <div class="header">
            <h3>
                Usuario actualizado con éxito
            </h3>
      </div>
      <div class="success-buttons">
          <vue-button buttonText="VOLVER A PERFIL" @click="goToProfile"></vue-button>
      </div>

  </div>
</template>

<script>
export default {
    name: 'success',
    methods: {
        goToProfile: function(){
            this.$router.push('/profile')
        }
    }
}
</script>

<style>
.success-msg{
    background-color: #bbbbff;
    width: calc(100vw - 2rem);
    margin: 1rem;
    max-width: 52rem;
    display: flex;
    flex-direction: column;
    border-radius: 2px;
   
}
.success-buttons{
    width: 100%;
    text-align: center;
    padding-bottom: 1rem;
}
@media screen and (min-width: 1024px){
    .success-msg{
        margin-left: auto;
        margin-right: auto;
    }
}

</style>