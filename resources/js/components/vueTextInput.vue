<template>
  <input class='input' type='text' v-model="input" @input="sendInput">
</template>

<script>
export default {
    name: 'vue-input',
    data(){
        return {
            input: ''
        }
    },
    methods: {
        sendInput: function(){
            this.$emit('textInput', this.$data.input);
        }
    }
}
</script>

<style scoped>
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