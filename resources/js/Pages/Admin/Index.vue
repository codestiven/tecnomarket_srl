<template>
    <div class="flex h-screen">
        <!-- Panel lateral -->
        <aside class="w-64 bg-blue-800 text-white flex flex-col p-4">
            <!-- Información del admin -->
            <div class="flex items-center mb-6">
                <img src="https://via.placeholder.com/50" alt="Admin" class="rounded-full mr-3">
                <div>
                    <h2 class="text-xl font-bold">Administrador</h2>
                    <p>Bienvenido, Admin</p>
                </div>
            </div>

            <!-- Botones de navegación -->
            <nav class="flex-1 ">
                <ul>
                    <!-- Reportes primero -->
                    <li class="mb-2">
                        <button @click="selectSection('reportes')" :class="buttonClass('reportes')"
                            class="w-full text-left p-2 rounded transition-all">
                            <i class="fa-solid fa-chart-line mr-2"></i> Reportes
                        </button>
                    </li>
                    <!-- Carrousel después de Reportes -->
                    <li class="mb-2">
                        <button @click="selectSection('carrousel')" :class="buttonClass('carrousel')"
                            class="w-full text-left p-2 rounded transition-all">
                            <i class="fa-solid fa-images mr-2"></i> Carrousel
                        </button>
                    </li>
                    <!-- Productos después del Carrousel -->
                    <li class="mb-2">
                        <button @click="selectSection('productos')" :class="buttonClass('productos')"
                            class="w-full text-left p-2 rounded transition-all">
                            <i class="fa-solid fa-box mr-2"></i> Productos
                        </button>
                    </li>
                    <!-- Usuarios -->
                    <li class="mb-2">
                        <button @click="selectSection('usuarios')" :class="buttonClass('usuarios')"
                            class="w-full text-left p-2 rounded transition-all">
                            <i class="fa-solid fa-user mr-2"></i> Usuarios
                        </button>
                    </li>
                    <!-- Mensajes -->
                    <li class="mb-2">
                        <button @click="selectSection('mensajes')" :class="buttonClass('mensajes')"
                            class="w-full text-left p-2 rounded transition-all">
                            <i class="fa-solid fa-envelope mr-2"></i> Mensajes
                        </button>
                    </li>
                    <!-- Pedidos -->
                    <li class="mb-2">
                        <button @click="selectSection('pedidos')" :class="buttonClass('pedidos')"
                            class="w-full text-left p-2 rounded transition-all">
                            <i class="fa-solid fa-shopping-cart mr-2"></i> Pedidos
                        </button>
                    </li>
                </ul>
            </nav>

            <!-- Botón de salir -->
            <div class="mt-6">
                <button @click="selectSection('salir')"
                    :class="{ 'bg-red-600': currentSection === 'salir', 'bg-red-700 hover:bg-red-600': currentSection !== 'salir' }"
                    class="w-full text-left p-2 bg-red-700 hover:bg-red-600 rounded transition">
                    <i class="fa-solid fa-sign-out-alt mr-2"></i> Salir
                </button>
            </div>
        </aside>

        <!-- Contenido principal -->
        <main class="flex-1 p-6 bg-gray-100">
            <div v-if="currentSection === 'reportes'" class="overflow-y-auto">
                <h2 class="text-2xl font-bold">Reportes</h2>
                <p>Aquí puedes ver los reportes del sistema.</p>
            </div>
            <div v-if="currentSection === 'carrousel'" class="overflow-y-auto">
                <h2 class="text-2xl font-bold">Carrousel</h2>
                <Carrouser></Carrouser>
             </div>
                    <div v-if="currentSection === 'productos'" class="overflow-y-auto">
                        <Producto></Producto>
                    </div>
                    <div v-if="currentSection === 'usuarios'" class="overflow-y-auto">
                        <h2 class="text-2xl font-bold">Gestión de Usuarios</h2>
                        <p>Aquí puedes administrar los usuarios.</p>
                    </div>
                    <div v-if="currentSection === 'mensajes'" class="overflow-y-auto">
                        <h2 class="text-2xl font-bold">Mensajes</h2>
                        <p>Aquí puedes ver y gestionar los mensajes.</p>
                    </div>
                    <div v-if="currentSection === 'pedidos'" class="overflow-y-auto">
                        <h2 class="text-2xl font-bold">Gestión de Pedidos</h2>
                        <p>Aquí puedes administrar los pedidos.</p>
                    </div>
                    <div v-if="currentSection === 'salir'" class="overflow-y-auto">
                        <h2 class="text-2xl font-bold">Salir</h2>
                        <p>Has cerrado la sesión.</p>
                    </div>
        </main>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import Producto from "@/Pages/Admin/Producto.vue";
import Carrouser from "@/Pages/Admin/Carrouser.vue";

// Variable para controlar la sección actual
const currentSection = ref('reportes');

// Función para cambiar de sección
function selectSection(section) {
    currentSection.value = section;
}

// Función para definir la clase CSS del botón activo
function buttonClass(section) {
    return currentSection.value === section
        ? 'bg-blue-900 text-white transform scale-105'
        : 'bg-blue-700 text-white hover:bg-blue-600';
}
</script>

<style scoped>
/* Estilos adicionales para mejorar la transición y visibilidad del botón activo */
button {
    transition: background-color 0.3s ease, transform 0.2s ease;
}

/* Agregar espacio para el contenido dentro del panel principal en caso de desbordamiento */
main div {
    max-height: calc(100vh - 64px);
    /* Ajusta el valor según la altura de la barra lateral si es necesario */
    overflow-y: auto;
}
</style>
