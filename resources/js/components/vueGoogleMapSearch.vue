<template>
    <input id="googleinput" class='input' type="text" name='googleinput' v-model="location" @input="search">
</template>

<script>
import eventBus from '../eventBus';
export default {
    name: 'vue-google-map-search',
    data(){
        return {
            location: '',
            
            autocomplete: null,
        }
    },
    
    methods:{
        initAutocomplete: function(){
            if (this.$data.autocomplete == null){
                this.$data.autocomplete = new window.google.maps.places.Autocomplete(document.getElementById("googleinput"));
            }
        },
        search: function (){
            this.initAutocomplete();
            let autocomplete = this.$data.autocomplete;
            autocomplete.addListener("place_changed", function() {
            let place = autocomplete.getPlace();
            if (place.geometry){
                eventBus.$emit('setMapPosition', place)
            } 

        });
        }
    }
}
</script>

<style>
    .input{
    border-radius: 2px;
    width: calc(100% - 0.75rem);
    border-left: none;
    border-right: none;
    border: 1px solid #ababab;
    padding-left: 0.5rem;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    transition: border 0.2s;
}
.input.error{
    border: solid 1px red; 
}
</style>