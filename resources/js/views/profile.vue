<template>
    <section>
        <form action="" id="profile-info">
            <header>
                <h3>Información de perfil</h3>
            </header>
            <div class="form-step first-step" v-if='firstStep'>
                <div class="input-wrapper">
                    <label for="sexo">Indicar Sexo:</label>
                    <select name="sexo" id="form-sexo" v-model="sexo">
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
                    <input type="text" name="ubicacion" id='form-ubicacion'>

                </div>
            </div>
        </form>
        
        <div class="step-button">
            <vue-button buttonText='siguiente' btnEvent='next-step'></vue-button>
            <button type="submit" form="profile-info">Actualizar Datos</button>
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
    mounted(){
        

    },
    methods: {
        nextStep: function(){
            let script = document.createElement('script');
            script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyC3WXmGtwE7aG7kHvfGGiI_RqFJ3DDBAvs&callback=initMap';
            script.defer = true;
            script.async = true;
            firstStep = !firstStep;
            
        }
    }
    
}
</script>

<style>

</style>