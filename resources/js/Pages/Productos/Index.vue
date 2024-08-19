<script setup>
import { ref, watch } from 'vue';
import { Head, Link } from "@inertiajs/vue3";
import Header from "@/Components/Principales/Header.vue";
import Footer from "@/Components/Principales/Footer.vue";
import Cantidad from "@/Components/Unicos/Cantidad.vue";
import ProductCard from "@/Components/Principales/ProductCard.vue";
import axios from 'axios';

const props = defineProps({
  categorias: Array,
  marcas: Array
});

const filtros = ref({
  categoria_id: '',
  marca_id: '',
  en_oferta: ''
});

const productos = ref([]);
const links = ref([]);
const currentPage = ref(1);
const totalPages = ref(1);
const cargando = ref(false);

const filtrarProductos = async (page = 1) => {
  try {
    cargando.value = true; // Mostrar la barra de carga
    const response = await axios.get('/api/productos/filtrar', {
      params: { ...filtros.value, page }
    });
    productos.value = response.data.data;
    links.value = response.data.links;
    currentPage.value = response.data.current_page;
    totalPages.value = response.data.last_page;
  } catch (error) {
    console.error('Error al filtrar los productos:', error);
  } finally {
    cargando.value = false; // Ocultar la barra de carga
  }
};

const actualizarFiltros = (event) => {
  const { id, value } = event.target;
  filtros.value[id] = value;

  const queryString = new URLSearchParams(filtros.value).toString();
  history.replaceState(null, '', `?${queryString}`);

  filtrarProductos();
};

const cambiarPagina = (link) => {
  if (link.url) {
    const url = new URL(link.url);
    const page = url.searchParams.get('page');
    filtrarProductos(page);
    // Mover el scroll a la parte superior
    window.scrollTo(0, 0);
  }
};


const init = () => {
  const params = new URLSearchParams(window.location.search);
  filtros.value.categoria_id = params.get('categoria_id') || '';
  filtros.value.marca_id = params.get('marca_id') || '';
  filtros.value.en_oferta = params.get('en_oferta') || '';

  filtrarProductos();
};

init();
</script>

<template>

  <Head title="Productos" />

  <Header />

  <main>
    <div class="Productos">
      <div class="cantidad">
        <Cantidad />
      </div>

      <div class="placeholder">
        <div class="filtros">
          <div class="left">
            <select id="categoria_id"
              class="filtro bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              @change="actualizarFiltros">
              <option selected value="">Todas las Categorías</option>
              <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">
                {{ categoria.nombre }}
              </option>
            </select>

            <select id="marca_id"
              class="filtro bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              @change="actualizarFiltros">
              <option selected value="">Todas las Marcas</option>
              <option v-for="marca in marcas" :key="marca.id" :value="marca.id">
                {{ marca.nombre }}
              </option>
            </select>

            <select id="en_oferta"
              class="filtro bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              @change="actualizarFiltros">
              <option selected value="">Todos</option>
              <option value="solo_ofertas">Solo en Oferta</option>
              <option value="sin_ofertas">Sin Ofertas</option>
            </select>
          </div>
          <div class="right">
            <h1>Ordenar por :</h1>
            <button><img src="/images/lista.png" alt="" /></button>
            <button><img src="/images/red.png" alt="" /></button>
          </div>
        </div>

        <!-- Mostrar la barra de carga -->
        <div v-if="cargando" class="flex justify-center items-center mt-16">
          <div class="w-16 h-16 border-4 border-blue-500 border-t-transparent border-solid rounded-full animate-spin">
          </div>
        </div>

        <!-- Mostrar un mensaje si no hay productos -->
        <div v-if="!cargando && productos.length === 0" class="text-center mt-16">
          <h1 class="text-4xl font-bold text-gray-600">No se han encontrado productos</h1>
        </div>

        <!-- Diseño de cuadrícula para los productos -->
        <div v-if="!cargando && productos.length > 0"
          class="contenido grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
          <ProductCard v-for="producto in productos" :key="producto.id" :product="producto" />
        </div>

        <!-- Paginación -->
        <div v-if="!cargando && links.length > 2 && totalPages > 1" class="pagination flex justify-center mt-4">
          <div class="flex items-center gap-4">
            <!-- Botón de "Anterior" -->
            <button :disabled="!links[0].url" @click="cambiarPagina(links[0])"
              class="flex items-center gap-2 px-6 py-3 font-sans text-xs font-bold text-center text-blue-900 uppercase align-middle transition-all rounded-lg select-none hover:bg-blue-900/10 active:bg-blue-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
              type="button">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
              </svg>
              Anterior
            </button>

            <!-- Números de páginas -->
            <div class="flex items-center gap-2">
              <button v-for="(link, index) in links.slice(1, -1)" :key="index" @click="cambiarPagina(link)" :class="[
                'relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase transition-all',
                link.active ? 'bg-blue-900 text-white shadow-md shadow-blue-900/10 hover:shadow-lg hover:shadow-blue-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none' :
                  'text-blue-900 hover:bg-blue-900/10 active:bg-blue-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none'
              ]" type="button">
                <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                  {{ link.label }}
                </span>
              </button>
            </div>

            <!-- Botón de "Siguiente" -->
            <button :disabled="!links[links.length - 1].url" @click="cambiarPagina(links[links.length - 1])"
              class="flex items-center gap-2 px-6 py-3 font-sans text-xs font-bold text-center text-blue-900 uppercase align-middle transition-all rounded-lg select-none hover:bg-blue-900/10 active:bg-blue-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
              type="button">
              Siguiente
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"></path>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  </main>

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
  width: 84%;

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
  /* max-height: 800px;
  overflow-y: scroll; */
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
