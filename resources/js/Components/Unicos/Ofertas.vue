<template>

  <div class="Ofertas">
    <div class="cards">

      <Card @addToCart="handleAddToCart" @likeProduct="handleLikeProduct" />
      <Card />
      <Card />
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import Card from "@/Components/Principales/ProductCard.vue";
import Boton from "@/Components/Boton_principar.vue";


</script>

<style scoped>
/* Ofertas   -----------------------------------------*/
.Ofertas {
  width: 100%;
  height: auto;
  padding: 20px;

  background: rgb(106, 180, 227);
  background: linear-gradient(
    304deg,
    rgba(106, 180, 227, 1) 0%,
    rgba(81, 122, 167, 1) 100%
  );
}

.cards {
  display: grid;
  grid-template-columns: repeat(3, 1fr); /* Tres columnas */
  grid-template-rows: auto; /* Altura automática según el contenido */
  grid-gap: 20px;
  padding: 0 20px;
/* Espacio entre las celdas */
}

</style>
