<template>
    <section class='profile-info'>
        <form action="" id="profile-info" class='profile-info-form' @submit.prevent="updateProfile">
            <header>
                <h3>Información de perfil</h3>
            </header>
            <div class="form-step first-step" v-if='firstStep'>
                <div class="input-wrapper">
                    <label for="sexo">Indicar Sexo:</label>
                    <select name="sexo" id="form-sexo" @input="sexModel" placeholder='Seleccionar...' aria-placeholder="Seleccionar...">
                        <option value="" disabled selected>
                            Seleccionar...
                        </option>
                        <option value="masculino">
                            Masculino
                        </option>
                        <option value="femenino">
                            Femenino
                        </option>
                    </select>
                </div>
                <div class="input-wrapper">
                    <label for="altura">
                        Indicar Altura (en centímetros):
                    </label>
                    <vue-number-input  
                        min="0" 
                        max="220" 
                        placeholder="Indicar altura..." 
                        aria-placeholder="Indicar altura..."
                        name="altura"
                        id="form-altura"
                        @input="heightModel"
                    />
                </div>
                <div class="input-wrapper">
                    <label for="peso">
                        Indicar Peso (en Kilos):
                    </label>
                    <vue-number-input  
                        min="0" 
                        max="220" 
                        placeholder="Indicar peso..." 
                        aria-placeholder="Indicar peso..."
                        name="peso"
                        id="form-peso"
                        @input="weightModel"
                    />
                </div>
                <div class="input-wrapper">
                    <label for="Nacimiento">Fecha de nacimiento:</label>
                    <input type="date" name="fechaNac" id="form-fechaNac" @input="birthModel">
                </div>
            </div>
            <div class="form-step second-step" v-else>
                <div class="input-wrapper">
                    <label for="Ubicacion">Ubicación:</label>
                    <vue-google-map-search class='google-search'/>
                    <vue-google-map />
                </div>
            </div>
            <div class="step-button">
            <div class="first-step-buttons" v-if="firstStep">
                <vue-button buttonText='SIGUIENTE' @click='nextStep'></vue-button>
            </div>
            <div class="second-step-buttons" v-else>
                <vue-button buttonText='ATRAS' @click="goBack"></vue-button>
                <vue-button type="submit" form="profile-info" buttonText='ACTUALIZAR DATOS'></vue-button>
            </div> 
        </div>
        </form>
    
    </section>
</template>

<script>
export default {
    name: 'profile',
    data(){
        return {
            form: {
                sexo: '',
                altura: 0,
                peso: 0,
                fechaNac: '',
            },
            firstStep: true,
            
        }
    },
    methods: {
        nextStep: function(){
            console.log(this.$data.form);
            for (let i = 0; i < this.$data.form.length; i++){
                if(this.$data.form[i].length == 0 || this.$data.form[i] == 0){
                    console.log(this.$data.form[i]);
                    return;
                } else {
                    this.$data.firstStep = !this.$data.firstStep;
                }
            }

        },
        goBack: function(){
            this.$data.firstStep = !this.$data.firstStep;
        },
        sexModel: function(model){
            this.$data.form.sexo = model;
        },
        weightModel: function(model){
            this.$data.form.peso = model;
        },
        heightModel: function(model){
            this.$data.form.altura = model;
        },
        birthModel: function(model){
            this.$data.form.fechaNac = model;
        },
        updateProfile: function(){
            let data = document.querySelectorAll('input');
            console.log(data);
            let form = [];
            for (let i = 0; i < data.length; i++){
                form.push([data[i].id, data[i].value]);
            }
           
        }
       
    }
    
}
</script>

<style scoped>


.profile-info{
    background-color: #bbbbff;
    width: calc(100vw - 2rem);
    margin: 1rem;
    max-width: 52rem;
    display: flex;
    flex-direction: column;
    border-radius: 2px;
}
.profile-info-form{
    padding: 0 1rem;
}
.profile-info header{
    text-align: center;
}
.input-wrapper{
    padding-bottom: 1rem;
}
.google-search{
    margin-bottom: 1rem;
}
input[type=date]{
   
    padding: 0 1rem;
    height: 2rem;
    border-radius: 2px;
    border: 1px solid #ababab;
}
.step-button{
    text-align: center;
    padding-bottom: 1rem;
}
.map{
    width: 100%;
    height: 16rem;
}
@media screen and (min-width: 1024px){
    .profile-info{
        margin-left: auto;
        margin-right: auto;
    }
}

</style>