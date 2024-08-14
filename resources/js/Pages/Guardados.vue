<template>
  <div class="p-6 bg-gray-100 min-h-screen">
    <h1 class="text-2xl font-bold mb-4">Productos Guardados</h1>
    <div v-if="guardados.length === 0" class="text-center text-gray-600">
      No tienes productos guardados.
    </div>
    <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
      <div v-for="item in guardados" :key="item.id" class="bg-white shadow-md rounded-lg overflow-hidden">
        <img :src="item.producto.image" alt="Producto" class="w-full h-48 object-cover">
        <div class="p-4">
          <h2 class="text-xl font-semibold">{{ item.producto.nombre }}</h2>
          <p class="text-gray-700 mt-2">{{ item.producto.descripcion }}</p>
          <p class="text-gray-900 font-bold mt-2">Precio: ${{ item.producto.precio }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    guardados: Array
  }
};
</script>
