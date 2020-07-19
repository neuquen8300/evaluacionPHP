<template>
    <div id='map' class="map" ></div>

</template>

<script>
import eventBus from '../eventBus';
export default {
    name: 'vue-google-map',
    mounted(){
        let map = new window.google.maps.Map(document.getElementById('map'), {
            center: { lat: -34.603722, lng: -58.381592 },      
            zoom: 8
        })
        eventBus.$on('setMapPosition', (place) => {
            map.setCenter(place.geometry.location);
            let marker = new window.google.maps.Marker({
                map: map
            });
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
        });
        
    }

}
</script>

<style scoped>
.map{
    width: 100%;
    height: 100%;
}
</style>