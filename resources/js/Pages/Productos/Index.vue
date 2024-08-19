<script setup>
import { ref, watch } from 'vue';
import { Head, Link } from "@inertiajs/vue3";
import Header from "@/Components/Principales/Header.vue";
import Footer from "@/Components/Principales/Footer.vue";
import Cantidad from "@/Components/Unicos/Cantidad.vue";
import ProductCard from "@/Components/Principales/ProductCard.vue";
import axios from 'axios';

// Definir los props que recibes desde el controlador
const props = defineProps({
  categorias: Array,
  marcas: Array
});

// Estado para los filtros
const filtros = ref({
  categoria_id: '',
  marca_id: '',
  en_oferta: ''
});

const productos = ref([]);

// Función para filtrar productos
const filtrarProductos = async () => {
  try {
    const response = await axios.get('/productos/filtrar', {
      params: filtros.value
    });
    productos.value = response.data.productos;  
    console.log(productos.value);
  } catch (error) {
    console.error('Error al filtrar los productos:', error);
  }
};

// Función para manejar el cambio en los select y actualizar filtros
const actualizarFiltros = (event) => {
  const { id, value } = event.target;
  filtros.value[id] = value;

  // Actualizar la URL con los parámetros de filtro
  const queryString = new URLSearchParams(filtros.value).toString();
  history.replaceState(null, '', `?${queryString}`);

  // Filtrar productos
  filtrarProductos();
};

// Verificar los parámetros en la URL al cargar la página
const init = () => {
  const params = new URLSearchParams(window.location.search);
  filtros.value.categoria_id = params.get('categoria_id') || '';
  filtros.value.marca_id = params.get('marca_id') || '';
  filtros.value.en_oferta = params.get('en_oferta') || '';

  // Cargar productos iniciales
  filtrarProductos();
};

// Llamar a la función init para inicializar filtros
init();
</script>

<template>
  <Head title="Productos" />

  <Header />

  <div class="Productos">
    <div class="cantidad">
      <Cantidad />
    </div>

    <div class="placeholder">
      <div class="filtros">
        <div class="left">
          <select id="categoria_id" class="filtro" @change="actualizarFiltros">
            <option selected value="">Todas las Categorías</option>
            <option v-for="categoria in props.categorias" :key="categoria.id" :value="categoria.id">
              {{ categoria.nombre }}
            </option>
          </select>

          <select id="marca_id" class="" @change="actualizarFiltros">
            <option selected value="">Todas las Marcas</option>
            <option v-for="marca in props.marcas" :key="marca.id" :value="marca.id">
              {{ marca.nombre }}
            </option>
          </select>

          <select id="en_oferta" class="" @change="actualizarFiltros">
            <option selected value="">Todos</option>
            <option value="solo_ofertas">Solo en Oferta</option>
            <option value="sin_ofertas">Sin Ofertas</option>
          </select>
        </div>
        <div class="right">
          <h1>Ordenar por :</h1>
          <button><img src="/images/lista.png" alt="Lista" /></button>
          <button><img src="/images/red.png" alt="Red" /></button>
        </div>
      </div>
      <div class="contenido">
        <ProductCard
          v-for="producto in productos"
          :key="producto.id"
          :product="producto"
        />
      </div>
      <div class="pagination">
        <!-- Aquí puedes agregar la lógica para la paginación si la necesitas -->
      </div>
    </div>
  </div>

  <Footer />
</template>


<style scoped>
.Productos {
  display: flex;
  align-items: start;
  justify-content: center;
  padding-top: 30px;
  height: auto;
}

.placeholder {
  width: 80%;

  display: grid;
  /* grid-template-rows: repeat(12, 1fr); */
  /* gap: 10px; */
  height: auto;
}

.filtros {
  display: grid;
  grid-template-columns: repeat(12, 1fr); /* 12 columnas igualmente distribuidas */
  gap: 10px; /* Espacio entre los elementos */
}

.filtros .left {
  display: flex;

  grid-column: span 9;
  justify-content: flex-start;
  align-items: flex-start;
  padding-right: 40%;
  gap: 30px;
}

.filtros .left select {
  background-color: transparent;
  border: none;
  outline: none;
  appearance: none;

  font-size: 20px;
}

.filtros .right {
  display: flex;
  grid-column: span 3;
  justify-content: flex-start;
  align-items: center;
  gap: 30px;
  font-size: 20px;
  font-weight: bold;
}

.filtros .right button {
  width: 40px;
  background-color: #e2e2e2;
  padding: 5px;
  border-radius: 7px;
  border: none;
  cursor: pointer;
}

.filtros .right button:hover {
  transform: scale(1.3);
}

.filtros .right button:active {
  background-color: #a0a0a0;
}

.filtros .right button img {
  width: 100%;
}

.placeholder .contenido {
  margin: 20px;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  grid-auto-rows: 400px;
  gap: 10px;
  justify-content: center;
  max-height: 500px;
  overflow-y: scroll;
}

.placeholder .contenido::-webkit-scrollbar {
  width: 12px; /* Ajusta el ancho del scroll */
}

.placeholder .contenido::-webkit-scrollbar-track {
  background: #f1f1f1; /* Color del fondo del track */
  border-radius: 10px;
}

.placeholder .contenido::-webkit-scrollbar-thumb {
  background: #1E90FF; /* Color del scroll */
  border-radius: 10px;
  border: 2px solid #f1f1f1; /* Espacio alrededor del scroll */
}

.placeholder .contenido::-webkit-scrollbar-thumb:hover {
  background: #0b7dda; /* Color del scroll al pasar el cursor */
}

.placeholder .contenido::-webkit-scrollbar-thumb:active {
  background: #065a9e; /* Color del scroll al hacer clic */
}

@media (max-width: 1090px) {
  .cantidad {
    display: none;
  }
  .placeholder {
    width: 100%;
  }

  .filtros {
    overflow: scroll;
  }

  
 .filtros::-webkit-scrollbar {
  width: 12px; /* Ajusta el ancho del scroll */
}

 .filtros::-webkit-scrollbar-track {
  background: #f1f1f1; /* Color del fondo del track */
  border-radius: 10px;
}

 .filtros::-webkit-scrollbar-thumb {
  background: #1E90FF; /* Color del scroll */
  border-radius: 10px;
  border: 2px solid #f1f1f1; /* Espacio alrededor del scroll */
}
 .filtros::-webkit-scrollbar-thumb:hover {
  background: #0b7dda; /* Color del scroll al pasar el cursor */
}
 .filtros::-webkit-scrollbar-thumb:active {
  background: #065a9e; /* Color del scroll al hacer clic */
}

  .filtros .right {
    display: none;
  }
}

.pagination {
  display: flex;
  justify-content: center;
  margin-top: 30px;
}
</style>
