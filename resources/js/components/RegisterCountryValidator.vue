<template>
  <div class="">

  </div>
</template>

<script>
export default {
  mounted(){
    // console.log(document.getElementById('country_id'))

    document.getElementById('country_id').onchange = function (event){
      console.log(event.target.value)
      if (event.target.value == "" || event.target.value == null) {
        document.getElementById('other_country').classList.remove('hidden')
      }else{
        document.getElementById('other_country').classList.add('hidden')
        document.getElementById('other_country_value').value = ""
      }
    }
  }
}
</script>

<style lang="css" scoped>
</style>
