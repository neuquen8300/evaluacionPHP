<template>
  <input class='input' type="number" @input="input">
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
        this.$emit('input');
      }
    }
}
</script>

<style>

</style>