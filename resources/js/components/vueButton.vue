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
}
</style>