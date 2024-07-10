<!-- resources/js/Pages/Producto/Show.vue -->

<template>
  <div>
    <h1>{{ producto.id }}</h1>
    <h2>{{ producto.nombre }}</h2>
    <p>{{ producto.descripcion }}</p>
    <p>Precio: RD${{ producto.precio }}</p>
    <p>Categoría: {{ producto.categoria_id }}</p>
    <p>marca_id: {{ producto.marca_id }}</p>
    <p>oferta_id: {{ producto.oferta_id }}</p>
     <p>created_at {{ producto.created_at}}</p>
     <p>updated_at {{ producto.updated_at}}</p>
     <p>{{ producto.oferta_id }}</p>
    <!-- Otros campos según necesites -->
    <img :src="producto.image" alt="Imagen del Producto">

  </div>
</template>

<script>
export default {
  props: {
    producto: Object // Definir la estructura del objeto producto
  }
};
</script>

<style scoped>
/* Estilos específicos para este componente si es necesario */
</style>
