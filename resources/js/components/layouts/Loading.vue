<template>
    <div class="loading-box">
        <clip-loader :loading="loading" :color="color" :size="size"></clip-loader>
    </div>
</template>
<style>
  .loading-box {
      position: fixed;
      top: 40%;
      width: 25%;
      left: 0;
      right: 0;
      margin: auto;
      z-index: 999;
  }
</style>
<script>
    import ClipLoader from 'vue-spinner/src/ClipLoader.vue'

    export default {
        name: "Loading",
        data () {
            return {
                color: '#2c1407',
                size: '70px',
                margin: '2px',
                radius: '2px',
                loading: '',
            }
        },
        components: {
            ClipLoader
        }
    }
</script>
