<template>
    <div class="flex flex-col min-h-screen">

        <Head title="Carrito de Compras" />
        <Header />
        <main class="flex-1 container mx-auto p-4">
            <h1 class="text-2xl font-bold mb-4">Carrito de Compras</h1>

            <!-- Indicador de carga -->
            <div v-if="loading" class="flex justify-center items-center h-64">
                <svg class="animate-spin h-8 w-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 0 1 8-8v4a4 4 0 0 0 0 8v4a8 8 0 0 1-8-8z">
                    </path>
                </svg>
            </div>

            <!-- Mensaje si no hay productos -->
            <div v-if="!loading && productos.length === 0" class="text-center text-gray-700 mt-6">
                <p class="text-lg font-semibold">¡No hay productos en el carrito!</p>
            </div>

            <!-- Carrito de productos -->
            <div v-else class="bg-white shadow rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Imagen</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Producto</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Categoría</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Marca</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Oferta</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Precio</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Cantidad</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acción</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="item in productos" :key="item.id">
                                <td class="px-6 py-4">
                                    <img :src="item.image" alt="Imagen del producto"
                                        class="w-32 h-32 object-cover rounded">
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ item.nombre }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ item.categoria.nombre }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ item.marca.nombre }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <span v-if="item.oferta" class="text-green-600">Sí</span>
                                    <span v-else class="text-red-600">No</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">RD${{ Number(item.precio).toFixed(2) }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <div class="flex items-center space-x-2">
                                        <button @click="decreaseQuantity(item.id)"
                                            class="bg-blue-600 text-white px-2 py-1 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                            -
                                        </button>
                                        <input type="number" v-model.number="item.cantidad"
                                            class="w-16 text-center border border-gray-300 rounded-lg py-1" min="1"
                                            readonly />
                                        <button @click="increaseQuantity(item.id)"
                                            class="bg-blue-600 text-white px-2 py-1 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                            +
                                        </button>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <button @click="removeFromCart(item.id)" class="text-red-600 hover:text-red-900">
                                        <i class="fa-solid fa-trash"></i> Quitar
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Total con diseño mejorado -->
            <div v-if="!loading && productos.length > 0"
                class="mt-4 bg-blue-600 p-6 rounded-lg shadow-lg border border-gray-200">
                <h2 class="text-lg font-semibold text-white mb-4">Total</h2>
                <div class="flex justify-between mb-2">
                    <span class="text-white text-sm">Subtotal:</span>
                    <span class="text-white font-bold text-lg">RD$ {{ subtotal.toFixed(2) }}</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span class="text-white text-sm">ITBIS (18%):</span>
                    <span class="text-white font-bold text-lg">RD$ {{ itbis.toFixed(2) }}</span>
                </div>
                <div class="flex justify-between font-bold text-lg text-white">
                    <span>Total:</span>
                    <span>RD$ {{ total.toFixed(2) }}</span>
                </div>
            </div>

            <!-- Botón de comprar -->
            <div v-if="!loading && productos.length > 0" class="mt-6 flex justify-end">
                <button @click="checkout" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                    Comprar
                </button>
            </div>
        </main>

        <Footer />
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';

import { Head, Link } from "@inertiajs/vue3";
import Header from "@/Components/Principales/Header.vue";
import Footer from "@/Components/Principales/Footer.vue";

// Definir refs para productos y estado de carga
const productos = ref([]);
const loading = ref(true);

// Función para obtener los IDs del carrito del localStorage y enviar la solicitud a la API
const fetchCartProducts = async () => {
    try {
        const cartIds = JSON.parse(localStorage.getItem('cart')) || [];
        if (cartIds.length > 0) {
            const response = await axios.post('/api/productos/por-ids', {
                ids: cartIds
            });

            // Convertir precios a números y añadir cantidad por defecto
            productos.value = response.data.productos.map(producto => ({
                ...producto,
                precio: Number(producto.precio),
                cantidad: 1 // Cantidad inicial por defecto
            }));
        }
        loading.value = false;
    } catch (error) {
        console.error('Error al obtener los productos del carrito:', error);
        loading.value = false;
    }
};

// Llamar a la función al montar el componente
onMounted(() => {
    fetchCartProducts();
});

// Función para eliminar un producto del carrito
const removeFromCart = (id) => {
    productos.value = productos.value.filter(item => item.id !== id);

    const remainingIds = productos.value.map(item => item.id);
    localStorage.setItem('cart', JSON.stringify(remainingIds));
};

// Función para aumentar la cantidad
const increaseQuantity = (id) => {
    const item = productos.value.find(item => item.id === id);
    if (item && item.cantidad < item.stock) {  // Verifica que la cantidad no supere el stock
        item.cantidad++;
    }
};

// Función para disminuir la cantidad
const decreaseQuantity = (id) => {
    const item = productos.value.find(item => item.id === id);
    if (item && item.cantidad > 1) {  // Asegura que la cantidad no sea menor a 1
        item.cantidad--;
    }
};

// Cálculo del subtotal, ITBIS y total
const subtotal = computed(() => productos.value.reduce((total, item) => total + item.precio * item.cantidad, 0));
const itbis = computed(() => subtotal.value * 0.18);
const total = computed(() => subtotal.value + itbis.value);

// Función para realizar la compra
const checkout = () => {
    // Aquí iría la lógica para proceder al checkout (enviar el carrito al backend, etc.)
    alert('Funcionalidad de compra no implementada');
};
</script>