<template>
  <div class="destacados">
    <div class="Cartas" ref="cartasContainer">
      <transition-group name="fade-slide">
        <Card
          v-for="(product, index) in visibleProducts"
          :key="product.id"
          :imageUrl="product.imageUrl"
          :productName="product.productName"
          :price="product.price"
        />
      </transition-group>
    </div>

    <div class="boton">
      <Boton @click="handleClick">{{ verMas ? "Ver menos" : "Ver más" }}  <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/></svg></Boton>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import Card from "@/Components/Principales/ProductCard.vue";
import Boton from "@/Components/Boton_principar.vue";

const verMas = ref(false);
const cartasContainer = ref(null);

const productos = ref([
  {
    id: 1,
    // imageUrl: "ruta/imagen1.jpg",
    productName: "Producto 1",
    price: 1000,
  },
  {
    id: 2,
    // imageUrl: "ruta/imagen2.jpg",
    productName: "Producto 2",
    price: 1500,
  },
  {
    id: 3,
    // imageUrl: "ruta/imagen3.jpg",
    productName: "Producto 3",
    price: 800,
  },
  {
    id: 3,
    // imageUrl: "ruta/imagen3.jpg",
    productName: "Producto 3",
    price: 800,
  },
  {
    id: 3,
    // imageUrl: "ruta/imagen3.jpg",
    productName: "Producto 3",
    price: 800,
  },
  {
    id: 3,
    // imageUrl: "ruta/imagen3.jpg",
    productName: "Producto 3",
    price: 800,
  },
  {
    id: 3,
    // imageUrl: "ruta/imagen3.jpg",
    productName: "Producto 3",
    price: 800,
  },
  {
    id: 3,
    // imageUrl: "ruta/imagen3.jpg",
    productName: "Producto 3",
    price: 800,
  },
    {
    id: 3,
    // imageUrl: "ruta/imagen3.jpg",
    productName: "Producto 3",
    price: 800,
  },
    {
    id: 3,
    // imageUrl: "ruta/imagen3.jpg",
    productName: "Producto 3",
    price: 800,
  },
    {
    id: 3,
    // imageUrl: "ruta/imagen3.jpg",
    productName: "Producto 3",
    price: 800,
  },
  // Agrega más productos según sea necesario
]);

const visibleProducts = ref([]);

// Función para manejar el botón "Ver más"
const handleClick = () => {
  verMas.value = !verMas.value;

  if (verMas.value) {
    mostrarTodosLosProductos();
  } else {
    mostrarSoloTresProductos();
  }
};

// Función para mostrar todos los productos
const mostrarTodosLosProductos = () => {
  visibleProducts.value = productos.value.slice(); // Mostrar todos los productos
};

// Función para mostrar solo los tres primeros productos
const mostrarSoloTresProductos = () => {
  visibleProducts.value = productos.value.slice(0, 8); // Mostrar solo los tres primeros productos
  // Scroll hacia arriba para mostrar el inicio de los productos
  if (cartasContainer.value) {
    cartasContainer.value.scrollTop = 0;
  }
};

// Al montar el componente, mostrar solo los tres primeros productos inicialmente
onMounted(() => {
  mostrarSoloTresProductos();
});
</script>

<style scoped>

*{
    transition: 0.5S;
}
.destacados {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-start;
  /* background-color: #fff; */
  padding: 0px 40px;
}

.Cartas {
  margin: 20px;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 50px;
  justify-content: center;
}

.boton {
  margin-top: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.fade-slide-enter-active,
.fade-slide-leave-active {
  transition: opacity 0.5s, transform 0.5s;
}
.fade-slide-enter,
.fade-slide-leave-to {
  opacity: 0;
  transform: translateY(20px);
}
</style>
