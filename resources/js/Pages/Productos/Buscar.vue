<template>
  <Head :title="buscado" />
  <Header />
<div class="buscado">
<h3>productos:</h3> <h1>{{ buscado }}</h1>
</div>


  <div class="product-grid">
    <template v-if="productos.length > 0">
      <Card
        v-for="producto in productos"
        :key="producto.id"
        :product="producto"
      />
    </template>
    <template v-else>
      <div class="no-products">
        <p>No se encontraron productos.</p>
      </div>
    </template>
  </div>

  <Footer />
</template>

<script setup>
import { defineProps } from 'vue';
import Card from '@/Components/Principales/ProductCard.vue';
import { Head } from "@inertiajs/vue3";
import Header from "@/Components/Principales/Header.vue";
import Footer from "@/Components/Principales/Footer.vue";
import Titulo from "@/Components/Titulos.vue";

const props = defineProps({
  productos: {
    type: Array,
    required: true
  },
  buscado: {
    type: String,
    required: false
  }
});

console.log(props.productos[0]);
</script>

<style scoped>

.buscado {
  background-color: #e2e8f0; /* bg-gray-200 */
  text-align: left;
  padding: 40px;
  font-size: 45px;
  display: flex;

}

.buscado h1{
  font-weight: bold;
  margin-left: 10px;
}

.product-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 20px;
  padding: 20px;
}

.no-products {
  background-color: #e2e8f0; /* bg-gray-200 */
  text-align: center;
  padding: 20px;
}
</style>
