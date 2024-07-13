<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Header from "@/Components/Principales/Header.vue";
import Footer from "@/Components/Principales/Footer.vue";
import Cantidad from "@/Components/Unicos/Cantidad.vue";

// import Filtro from "@/Components/Unicos/Filtro.vue";

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
  <Cantidad />
  </div>






  <div class="placeholder">
  <div class="filtros">
  <div class="left">


  <select id="countries" class="filtro">
    <option selected>Todos</option>
    <option value="US">United States</option>
    <option value="CA">Canada</option>
    <option value="FR">France</option>
    <option value="DE">Germany</option>
  </select>


    <select id="countries" class="">
    <option selected>Todos</option>
    <option value="US">United States</option>
    <option value="CA">Canada</option>
    <option value="FR">France</option>
    <option value="DE">Germany</option>
  </select>

    <select id="countries" class="">
    <option selected>Todos</option>
    <option value="US">United States</option>
    <option value="CA">Canada</option>
    <option value="FR">France</option>
    <option value="DE">Germany</option>
  </select>


  
  
  </div>
  <div class="right">
  <h1>Odenar por :</h1>
  
  </div>
  </div>
  <div class="contenido"></div>
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
  min-height: 550px;
  background-color: red;
  

}
.placeholder{
  width: 75%;
  height: auto;

}

.filtros{
  display: grid;
  grid-template-columns: repeat(12, 1fr); /* 12 columnas igualmente distribuidas */
  gap: 10px; /* Espacio entre los elementos */
}

.filtros .left{
  display: flex;

  grid-column: span 9; 
  justify-content: flex-start;
  align-items: flex-start;
  padding-right: 40%;
  gap:30px
}

.filtros .left select{
  background-color: transparent;
  border: none;
  outline: none;
  appearance: none;

  font-size: 20px;
}



.filtros .right{
  display: flex;

  grid-column: span 3; /* Ocupa 2 columnas */
  
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
