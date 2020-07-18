<template>
    <button class='vue-button'>{{buttonText}}</button>    
</template>

<script>
export default {
    name: 'vue-button',
    props: ['btnEvent', 'buttonText'],
    methods: {
        btnPressed: function(){
            this.$emit(this.$props.btnEvent);
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