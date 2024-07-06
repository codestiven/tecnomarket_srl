<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Header from "@/Components/Principales/Header.vue";
import Footer from "@/Components/Principales/Footer.vue";
import Titulo from "@/Components/Titulos.vue";
import Carruser from "@/Components/Unicos/Carrusel.vue";
import boton1 from "@/Components/Boton_principar.vue";
import Mapa from "@/Components/mapa.vue";
import Destacados from "@/Components/Unicos/Destacados.vue";
import Ofertas from "@/Components/Unicos/Ofertas.vue";

defineProps({
  canLogin: {
    type: Boolean,
  },
  canRegister: {
    type: Boolean,
  },
  laravelVersion: {
    type: String,
    required: true,
  },
  phpVersion: {
    type: String,
    required: true,
  },
});

function handleImageError() {
  document.getElementById("screenshot-container")?.classList.add("!hidden");
  document.getElementById("docs-card")?.classList.add("!row-span-1");
  document.getElementById("docs-card-content")?.classList.add("!flex-row");
  document.getElementById("background")?.classList.add("!hidden");
}
</script>

<template>
  <Head title="Productos" />

  <Header/>

  <div class="Productos">
  <div class="cantidad">
  a
  </div>
  <div class="placeholder">
  b
  </div>
  </div>







<Footer/>
</template>

<style scoped>

.Productos{
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 3%;
}
.cantidad{
  width: 25%;
  height: 100px;
  background-color: black;
}
.placeholder{
  width: 75%;
  height: auto;
  background-color: rgb(238, 16, 16);
}

@media (max-width: 1024px) {
  .cantidad{
    display: none;
  }
  .placeholder{
  width: 100%;
;
}
}

</style>
