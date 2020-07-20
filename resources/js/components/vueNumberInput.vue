<template>
  <input class='input' type="number" @input="input" v-model="numberInput">
</template>

<script>
export default {
    name: 'vue-number-input',
    data(){
      return {
        numberInput: 0
      }
    },
    methods: {
      input: function(){
        this.$emit('input', this.$data.numberInput);
      }
    }
}
</script>

<style>

</style>