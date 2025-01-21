<template>

  <div class="destacados">
    <Titulo titulo="Artículos Destacados" :mostrarLinea="false" />
    <div v-if="productos.length > 0" class="Cartas" ref="cartasContainer">
      <transition-group name="fade-slide">
        <Card v-for="(producto, index) in visibleProducts" :key="producto.id" :product="producto" />
      </transition-group>
    </div>

    <div v-else class="mensaje-pronto">
      <p>¡Habrá pronto!</p>
    </div>

    <div v-if="productos.length > 0" class="boton">
      <Boton @click="handleClick">
        {{ verMas ? "Ver menos" : "Ver más" }}
        <svg :class="[verMas ? 'rotado' : '', 'w-4', 'h-4']" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
          <path
            d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
        </svg>
      </Boton>
    </div>
  </div>
</template>


<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import Card from "@/Components/Principales/ProductCard.vue";
import Boton from "@/Components/Boton_principar.vue";
import Titulo from "@/Components/Titulos.vue";

const verMas = ref(false);
const cartasContainer = ref(null);

const productos = ref([]);
const visibleProducts = ref([]);

const handleClick = () => {
  verMas.value = !verMas.value;

  if (verMas.value) {
    mostrarTodosLosProductos();
  } else {
    mostrarSoloProductosLimitados();
  }
};

const mostrarTodosLosProductos = () => {
  visibleProducts.value = productos.value.slice();
};

const mostrarSoloProductosLimitados = () => {
  visibleProducts.value = productos.value.slice(0, 12);
  if (cartasContainer.value) {
    cartasContainer.value.scrollTop = 0;
  }
};

const cargarProductos = async () => {
  try {
    const response = await axios.get("/api/Productoliked");
    productos.value = response.data.map(item => item.producto);
    mostrarSoloProductosLimitados();
  } catch (error) {
    console.error("Error al cargar los productos:", error);
  }
};

onMounted(() => {
  cargarProductos();
});
</script>

<style scoped>
* {
  transition: 0.5s;
}

.destacados {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-start;
  padding: 0px 40px;
  margin-top: 20px;
}

.Cartas {
  margin: 20px;
  display: grid;
  grid-template-columns: repeat(4, 2fr);
  gap: 50px;
  justify-content: center;
}

@media (max-width: 1150px) {
  .Cartas {
    grid-template-columns: repeat(2, 2fr);
  }
}

@media (max-width: 768px) {
  .Cartas {
    grid-template-columns: repeat(1, 2fr);
  }
}

@media (max-width: 480px) {
  .Cartas {
    grid-template-columns: 1fr;
  }
}

.boton {
  margin-top: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.rotado {
  transform: rotate(180deg);
  transition: transform 0.5s ease;
}

.mensaje-pronto {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  margin-top: 30px;
  text-align: center;
  font-size: 2rem;
  /* Tamaño del texto grande */
  font-weight: bold;
  color: #1e90ff;
  /* Color del texto azul */
  background-color: #bebebe;
  width: 100%;
  height: 180px;
  /* Fondo gris claro */
  padding: 20px;
  border-radius: 10px;
  /* Bordes redondeados */
  transition: background-color 0.3s ease, color 0.3s ease;
  /* Transiciones para hover */
}

.mensaje-pronto:hover {
  background-color: #e0e0e0;
  /* Fondo gris oscuro al pasar el cursor */
  color: #4169e1;
  /* Texto azul oscuro al pasar el cursor */
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

