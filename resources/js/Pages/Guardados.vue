<template>

  <Head title="Guardados" />
  <Header />
  <main class="px-6 py-8 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto">
      <!-- Breadcrumb Navigation -->
      <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol
          class="inline-flex items-center space-x-2 md:space-x-4 rtl:space-x-reverse text-lg font-medium text-gray-700">
          <li class="inline-flex items-center">
            <a href="/"
              class="inline-flex items-center text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
              <svg class="w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                  d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
              </svg>
              Home
            </a>
          </li>
          <li>
            <div class="flex items-center">
              <svg class="rtl:rotate-180 w-4 h-4 text-gray-400 mx-2" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="m1 9 4-4-4-4" />
              </svg>
              <a href="/micuenta" class="text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">Mi
                Cuenta</a>
            </div>
          </li>
          <li aria-current="page">
            <div class="flex items-center">
              <svg class="rtl:rotate-180 w-4 h-4 text-gray-400 mx-2" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="m1 9 4-4-4-4" />
              </svg>
              <span class="text-gray-500">Guardados</span>
            </div>
          </li>
        </ol>
      </nav>

      <!-- Main Content -->
      <h1 class="text-5xl font-bold text-gray-800 text-center mb-8">Productos Guardados</h1>
      <div v-if="guardados.length === 0" class="text-center text-gray-600">
        <p class="text-lg mb-4">No tienes productos guardados.</p>
        <p class="text-sm text-gray-500">¡Empieza a guardar tus productos favoritos para encontrarlos fácilmente aquí!
        </p>
      </div>
      <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <ProductCard v-for="item in guardados" :key="item.id" :product="item.producto" />
      </div>
    </div>
  </main>
  <Footer />
</template>

<script setup>
import ProductCard from "@/Components/Principales/ProductCard.vue";
import { defineProps } from 'vue';
import { Head } from "@inertiajs/vue3";
import Header from "@/Components/Principales/Header.vue";
import Footer from "@/Components/Principales/Footer.vue";

// Define las propiedades que recibe el componente
const props = defineProps({
  guardados: Array
});
</script>
