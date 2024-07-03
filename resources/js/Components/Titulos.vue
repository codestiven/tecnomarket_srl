<template>
    <div class="elemento flex flex-col items-center">
        <h1 class="mb-4">{{ titulo }}</h1>
        <h2 v-if="subtitulo">{{ subtitulo }}</h2>
    </div>
</template>

<script>
export default {
    props: {
        titulo: {
            type: String,
            required: true
        },
        subtitulo: {
            type: String,

        }
    }
}
</script>

<style scoped>
  .elemento {
      margin: 100px 0px 100px 0px;
  }

  h1 {
    font-size: 48px;
    color: #2B2B2B;
    font-weight: bold;


  }

  h2 {
    font-size: 24px;
    color: #2b2b2bab;


  }
</style>
