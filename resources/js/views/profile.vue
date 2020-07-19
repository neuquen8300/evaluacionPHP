<template>
    <section class='profile-info'>
        <form action="" id="profile-info" class='profile-info-form' @submit.prevent="updateProfile">
            <header>
                <h3>Información de perfil</h3>
            </header>
            <div class="form-step first-step" v-if='firstStep'>
                <div class="input-wrapper">
                    <label for="sexo">Indicar Sexo:</label>
                    <select name="sexo" id="form-sexo" v-model="sexo" placeholder='Seleccionar...' aria-placeholder="Seleccionar...">
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
                        v-model='altura'
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
                        v-model='peso'
                    />
                </div>
                <div class="input-wrapper">
                    <label for="Nacimiento">Fecha de nacimiento:</label>
                    <input type="date" name="fechaNac" id="form-fechaNac" v-model='fechaNac'>
                </div>
            </div>
            <div class="form-step second-step" v-else>
                <div class="input-wrapper">
                    <label for="Ubicacion">Ubicación:</label>
                    <vue-text-input name="ubicacion" id='form-ubicacion' @textInput='searchAdress' />
                    <div id='map' class="map" @show="initMap" @>
                        
                    </div>
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
            firstStep: true
        }
    },
    methods: {
        nextStep: function(){
            this.$data.firstStep = !this.$data.firstStep;          
        },
        goBack: function(){
            this.$data.firstStep = !this.$data.firstStep;
        },
        initMap: function(){
            map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: -34.397, lng: 150.644 },      
                zoom: 8
            })
        },
        searchAdress: function(){
            fetch('https://maps.googleapis.com/maps/api/place/findplacefromtext/json?parameters', {
                body: {
                     // Opciones
                }
            })
        }
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
    width: 8rem;
    height: 8rem;
}

</style>