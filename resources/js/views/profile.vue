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
                        value="0"
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
                        value="0"
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
                    <vue-google-map-search />
                    <vue-google-map></vue-google-map>
                </div>
            </div>
        </form>
        
        <div class="step-button">
            <div class="first-step-buttons" v-if="firstStep">
                <vue-button buttonText='SIGUIENTE' @click='nextStep'></vue-button>
            </div>
            <div class="second-step-buttons" v-else>
                <vue-button buttonText='ATRAS' @click="goBack"></vue-button>
                <vue-button type="submit" form="profile-info" buttonText='ACTUALIZAR DATOS'></vue-button>
            </div> 
        </div>
    </section>
</template>

<script>
export default {
    name: 'profile',
    data(){
        return {
            sexo: '',
            altura: 0,
            peso: 0,
            fechaNac: '',
            firstStep: true,

        }
    },
    methods: {
        nextStep: function(){
            this.$data.firstStep = !this.$data.firstStep;          
        },
        goBack: function(){
            this.$data.firstStep = !this.$data.firstStep;
        },
        sexModel: function(model){
            this.$data.sexo = model;
        },
        weightModel: function(model){
            this.$data.peso = model;
        },
        heightModel: function(model){
            this.$data.altura = model;
        },
        birthModel: function(model){
            this.$data.fechaNac = model;
        },
        
       
    }
    
}
</script>

<style scoped>


.profile-info{
    background-color: #bbbbff;
    width: calc(100vw - 2rem);
    margin: 1rem;
    
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
input[type=date]{
   
    padding: 0 1rem;
    height: 2rem;
    border-radius: 2px;
    border: 1px solid #ababab;
}
.step-button{
    text-align: center;
}
.map, #map{
    width: 100%;
    height: 8rem;
}

</style>