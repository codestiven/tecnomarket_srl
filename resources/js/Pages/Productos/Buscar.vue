<template>
  <div>
    <template v-if="productos.length > 0">
      <Card v-for="producto in productos" :key="producto.id"
            :id="producto.id"
            :productName="producto.nombre"
            :descripcion="producto.descripcion"
            :price="producto.precio"
            :id_categoria="producto.categoria_id"
            :id_marca="producto.marca_id"
            :id_oferta="producto.oferta_id"
            :imageUrl="producto.image"
      />
    </template>
    <template v-else>
      <div class="bg-gray-200 text-center p-5">
        <p>No se encontraron productos.</p>
      </div>
    </template>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
import Card from '@/Components/Principales/ProductCard.vue'; // Ajusta la ruta según la ubicación correcta de tu componente Card

const props = defineProps({
  productos: {
    type: Array,
    required: true
  }
});
</script>

<style scoped>
/* Estilos específicos para este componente si es necesario */
</style>
