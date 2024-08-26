<template>
    <div class="flex flex-col h-screen bg-gray-100">
        <!-- Barra de navegación superior -->
        <nav class="bg-gray-800 text-white flex-none">
            <div class="flex">
                <button @click="currentView = 'agregar'" :class="{
                    'bg-green-600': currentView === 'agregar',
                    'bg-gray-700': currentView !== 'agregar'
                }" class="flex-1 p-3 text-center transition duration-300">
                    Agregar
                </button>
                <button @click="currentView = 'editar'" :class="{
                    'bg-blue-600': currentView === 'editar',
                    'bg-gray-700': currentView !== 'editar'
                }" class="flex-1 p-3 text-center transition duration-300">
                    Editar
                </button>
                <button @click="currentView = 'borrar'" :class="{
                    'bg-red-600': currentView === 'borrar',
                    'bg-gray-700': currentView !== 'borrar'
                }" class="flex-1 p-3 text-center transition duration-300">
                    Borrar
                </button>
            </div>
        </nav>

        <!-- Contenido dinámico -->
        <main class="flex-1 p-6 bg-white">
            <div v-if="currentView === 'agregar'" class="p-4">
                <Crear />
            </div>
            <div v-if="currentView === 'editar'" class="p-4">
                <Editar />
            </div>
            <div v-if="currentView === 'borrar'" class="p-4">
                <Borrar />
            </div>
        </main>
    </div>
</template>

<script setup>
import { ref } from 'vue';
// Importar el componente Crear.vue
import Crear from './Producto/Crear.vue';
import Editar from './Producto/Editar.vue';
import Borrar from './Producto/Borrar.vue';

// Variable para controlar la vista actual
const currentView = ref('agregar');
</script>

<style scoped>
/* Estilos adicionales para mejorar la presentación */
nav button {
    transition: background-color 0.3s ease;
}
</style>
