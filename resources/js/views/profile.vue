<template>
    <section class='profile-info'>
        <form action="" id="profile-info" class='profile-info-form' @submit.prevent="updateProfile">
            <header>
                <h3>Información de perfil</h3>
            </header>
            <div class="form-step first-step" v-if='firstStep'>
                <div class="input-wrapper">
                    <label for="sexo">Indicar Sexo:</label>
                    <select name="sexo" id="form-sexo" @input="sexModel" placeholder='Seleccionar...' aria-placeholder="Seleccionar..." >
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
                    <input type="date" 
                    name="fechaNac" 
                    id="form-fechaNac" @input="birthModel" >
                    
                </div>
            </div>
            <div class="form-step second-step" v-else>
                <div class="input-wrapper">
                    <label for="Ubicacion">Ubicación:</label>
                    <vue-google-map-search class='google-search'/>
                    <vue-google-map />
                </div>
            </div>
            
        </form>
        <div class="step-button">
            <div class="first-step-buttons" v-if="firstStep">
                <div class="errorMsg" v-if="errorCheck">{{errorMsg}}</div>
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
import eventBus from '../eventBus';
export default {
    name: 'profile',
    data(){
        
        return {
            form: {
                sexo: '',
                altura: null,
                peso: null,
                fechaNac: '',
                ubicacion: ''
        },
            firstStep: true,
            errorCheck: 0,
            errorMsg: ''
        }
    },
    mounted(){
        eventBus.$on('setMapPosition', (place) => {
            this.$data.form.ubicacion = place.formatted_address;
        })
    },
    methods: {
        nextStep: function(){
            let select = document.querySelector('select');
            let input = document.querySelectorAll('input');
            this.$data.errorCheck = 0;
            this.$data.errorMsg = '';
            // Si hay errores en inputs, error++
            for (let i = 0; i < input.length; i++){
                if((input[i].value === 0 || input[i].value === '')){
                    this.$data.errorCheck++;
                   this.setInputError(input[i].id);
                } else {
                    this.errorDismiss(input[i].id);
                }
            }
           // Si no esta seleccionado el sexo, error++
            if (select.value.length == 0){
                this.$data.errorCheck++;
                this.setInputError(select.id);
            }
            
            // Si no sos mayor de 18 años, error++
            if (!this.ageValidation()){
                this.$data.errorMsg = "Tenes que ser mayor de 18 años."
                this.$data.errorCheck++;
            }

            //Si no hay errores, se procede al siguiente cuadro.
            (this.$data.errorCheck == 0) ? this.$data.firstStep = !this.$data.firstStep : null;
        },
        goBack: function(){
            this.$data.firstStep = !this.$data.firstStep;
        },
        sexModel: function(model){
            
            this.$data.form.sexo = model.target.value;
        },
        weightModel: function(model){
            
            this.$data.form.peso = model;
        },
        heightModel: function(model){
            this.$data.form.altura = model;
        },
        birthModel: function(model){
            this.$data.form.fechaNac = model.target.value;
        },
        ageValidation: function(){

            // Obtenemos datos actuales y los seleccionados por el usuario.
            // Los convertimos a arrays.
            // Calculamos si el usuario es mayor de edad: 
            // Primero por el año, luego, por los meses por si yearsCalc es 18 o mas pero monthCalc es < a 0,
            // Devuelve isPermitted siendo true si está permitido o false si lo contrario.

            let currentDate = new Date();
            let arrayDate = [currentDate.getFullYear(), currentDate.getMonth() + 1, currentDate.getDate()];
            let inputDate = this.$data.form.fechaNac.split('-');
            let yearsCalc = inputDate[0] ? parseInt(arrayDate[0]) - inputDate[0] : false;
            let monthCalc = parseInt(arrayDate[1]) - inputDate[1];
            let daysCalc = parseInt(arrayDate[2]) - inputDate[2];
            let isPermitted = false;
            function calc(){
                return yearsCalc >= 18
            }
            if (calc()){
                isPermitted = true;
            } else {
                if (monthCalc >= 0 && daysCalc > 0){
                    yearsCalc++;
                    if (calc()) isPermitted = true;
                } else if (monthCalc > 0){
                    yearsCalc++;
                    if (calc()) isPermitted = true;
                } else if (monthCalc < 0 && yearsCalc == 18){
                    yearsCalc--;
                }
            }
            return isPermitted;
        },
        updateProfile: function(){
            let data = this.$data.form;
            let form = new FormData;
            form.append('sexo', data.sexo);
            form.append('peso', data.peso);
            form.append('altura', data.altura);
            form.append('fechaNac', data.fechaNac);
            form.append('ubicacion', data.ubicacion);

            fetch(process.env.MIX_APP_URL + '/api/updateProfile', {
                method: 'POST',
                body: form,
                headers: {
                    'Authorization': 'Bearer ' + sessionStorage.getItem('access_token')
                }
            })
            .then(res => {
                return res.json();
            })
            .then(data => {
                if(data.status == 'ok'){
                    this.$router.push('/success');
                }
            })
            .catch(e => {
                return e;
            })
        },
        setInputError: function(formInput){
            document.getElementById(formInput).classList.add('error');
            this.$data.errorMsg = "Faltan completar campos";
        },
        errorDismiss(formInput){
            document.getElementById(formInput).classList.remove('error');
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
.errorMsg{
    padding-bottom: 1rem;
}
@media screen and (min-width: 1024px){
    .profile-info{
        margin-left: auto;
        margin-right: auto;
    }
}

</style>