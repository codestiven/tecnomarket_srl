<template>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-500 to-blue-900">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-xl w-full">
            <!-- Imagen del producto -->
            <div class="flex justify-center mb-6">
                <img :src="product.image" alt="Imagen del producto"
                    class="w-64 h-64 object-contain rounded-full shadow-md" />
            </div>

            <h2 class="text-3xl font-bold text-center text-blue-700 mb-6">Solicitud de Financiamiento</h2>

            <form @submit.prevent="submitForm" class="space-y-4">
                <!-- Nombre del producto -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Nombre del Producto</label>
                    <input type="text" v-model="form.nombre"
                        class="block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        disabled />
                </div>

                <!-- Precio del producto -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Precio del Producto</label>
                    <input type="text" v-model="form.precio"
                        class="block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        disabled />
                </div>

                <!-- Nombre del usuario -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Nombre Completo</label>
                    <input type="text" v-model="form.nombreUsuario"
                        class="block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required />
                </div>

                <!-- Correo del usuario -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Correo Electrónico</label>
                    <input type="email" v-model="form.correo"
                        class="block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required />
                </div>

                <!-- Cédula del usuario -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Cédula</label>
                    <input type="text" v-model="form.cedula"
                        class="block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required />
                </div>

                <!-- Dirección del usuario -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Dirección</label>
                    <input type="text" v-model="form.direccion"
                        class="block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required />
                </div>

                <!-- Motivo del financiamiento -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Motivo de la Solicitud</label>
                    <textarea v-model="form.motivo"
                        class="block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required></textarea>
                </div>

                <!-- Botón para enviar la solicitud por WhatsApp -->
                <button type="submit"
                    class="w-full flex items-center justify-center bg-green-500 text-white py-3 px-4 rounded-lg hover:bg-green-600 transition duration-200">
                    <i class="fa-brands fa-whatsapp mr-2"></i> Enviar Solicitud por WhatsApp
                </button>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

// Recibimos los datos del producto como props
const props = defineProps(['product']);

// Inicializamos el formulario
const form = ref({
    nombre: props.product.nombre,
    precio: props.product.precio,
    nombreUsuario: '',
    correo: '',
    cedula: '',
    direccion: '',
    motivo: ''
});

// Función para enviar la solicitud por WhatsApp
const submitForm = () => {
    const phoneNumber = '18098719279'; // Número de teléfono de la empresa
    const message = `*Solicitud de Financiamiento*\n
                   *Producto*: **${form.value.nombre}**\n
                   *Precio*: **${form.value.precio}**\n
                   *Nombre*: **${form.value.nombreUsuario}**\n
                   *Correo*: **${form.value.correo}**\n
                   *Cédula*: **${form.value.cedula}**\n
                   *Dirección*: **${form.value.direccion}**\n
                   *Motivo*: **${form.value.motivo}**`;

    const encodedMessage = encodeURIComponent(message);
    const url = `https://wa.me/${phoneNumber}?text=${encodedMessage}`;

    // Abrir WhatsApp en una nueva ventana
    window.open(url, '_blank');
};
</script>

<style scoped>
/* Estilo para el fondo degradado */
body {
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif;
}

.min-h-screen {
    min-height: 100vh;
}

.bg-gradient-to-r {
    background: linear-gradient(to right, #3b82f6, #1e3a8a);
}

/* Estilo personalizado para los inputs */
input,
textarea {
    outline: none;
    transition: all 0.3s ease;
}

input:focus,
textarea:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 5px rgba(59, 130, 246, 0.5);
}
</style>
