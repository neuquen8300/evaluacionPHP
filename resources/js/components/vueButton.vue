<template>
    <button class='vue-button' @click='click'>{{buttonText}}</button>    
</template>

<script>
export default {
    name: 'vue-button',
    props: ['buttonText'],
    methods: {
        click: function(){
            this.$emit('click');
        }
    }
}
</script>

<style scoped>
.vue-button{
    font-family: 'Metropolis';
    font-weight: 600;
    border: none;
    padding: 1rem;
    text-align: center;
    background-color: #1256ff;
    color: white;
    border-radius: 2px;
    box-shadow: 0px 0px 2px 0px rgba(0, 0, 0, 0.2);
}
</style>