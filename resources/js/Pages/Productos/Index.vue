<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Header from "@/Components/Principales/Header.vue";
import Footer from "@/Components/Principales/Footer.vue";
import Cantidad from "@/Components/Unicos/Cantidad.vue";
import ProductCard from "@/Components/Principales/ProductCard.vue";

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

  <Header />

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

          <button><img src="/images/lista.png" alt="" /></button>

          <button><img src="/images/red.png" alt="" /></button>
        </div>
      </div>
      <div class="contenido">
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
      </div>
      <div class="pagination">
        <div class="flex items-center gap-4">
          <button
            disabled
            class="flex items-center gap-2 px-6 py-3 font-sans text-xs font-bold text-center text-gray-900 uppercase align-middle transition-all rounded-lg select-none hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
            type="button"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="2"
              stroke="currentColor"
              aria-hidden="true"
              class="w-4 h-4"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"
              ></path>
            </svg>
            Anterior
          </button>
          <div class="flex items-center gap-2">
            <button
              class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg bg-gray-900 text-center align-middle font-sans text-xs font-medium uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
              type="button"
            >
              <span
                class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
              >
                1
              </span>
            </button>
            <button
              class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
              type="button"
            >
              <span
                class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
              >
                2
              </span>
            </button>
            <button
              class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
              type="button"
            >
              <span
                class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
              >
                3
              </span>
            </button>
            <button
              class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
              type="button"
            >
              <span
                class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
              >
                4
              </span>
            </button>
            <button
              class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
              type="button"
            >
              <span
                class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
              >
                5
              </span>
            </button>
          </div>
          <button
            class="flex items-center gap-2 px-6 py-3 font-sans text-xs font-bold text-center text-gray-900 uppercase align-middle transition-all rounded-lg select-none hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
            type="button"
          >
            Siguientes
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="2"
              stroke="currentColor"
              aria-hidden="true"
              class="w-4 h-4"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"
              ></path>
            </svg>
          </button>
        </div>
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
