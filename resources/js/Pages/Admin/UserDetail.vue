<!-- resources/js/Pages/UserDetail.vue -->
<template>
    <div class="p-6 max-w-4xl mx-auto">
        <div class="mb-4">
            <Link href="/admin"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <i class="fas fa-arrow-left mr-2"></i> Regresar
            </Link>
        </div>

        <div v-if="user" class="border border-gray-300 shadow-lg rounded-lg p-6 bg-white">
            <h1 class="text-3xl font-semibold mb-6 flex items-center">
                <i class="fas fa-user-circle text-blue-600 mr-3"></i> Detalles del Usuario
            </h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                    <p class="text-sm font-medium text-gray-700 flex items-center mb-2">
                        <i class="fas fa-id-badge text-blue-500 mr-2"></i>
                        ID:
                    </p>
                    <p class="text-lg">{{ user.id }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                    <p class="text-sm font-medium text-gray-700 flex items-center mb-2">
                        <i class="fas fa-user text-blue-500 mr-2"></i>
                        Nombre:
                    </p>
                    <p class="text-lg">{{ user.name }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                    <p class="text-sm font-medium text-gray-700 flex items-center mb-2">
                        <i class="fas fa-user-tag text-blue-500 mr-2"></i>
                        Apellido:
                    </p>
                    <p class="text-lg">{{ user.lastname }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                    <p class="text-sm font-medium text-gray-700 flex items-center mb-2">
                        <i class="fas fa-envelope text-blue-500 mr-2"></i>
                        Email:
                    </p>
                    <p class="text-lg">{{ user.email }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                    <p class="text-sm font-medium text-gray-700 flex items-center mb-2">
                        <i class="fas fa-home text-blue-500 mr-2"></i>
                        Dirección:
                    </p>
                    <p class="text-lg">{{ user.address }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                    <p class="text-sm font-medium text-gray-700 flex items-center mb-2">
                        <i class="fas fa-map-marker-alt text-blue-500 mr-2"></i>
                        Provincia:
                    </p>
                    <p class="text-lg">{{ user.provincia?.nombre || 'N/A' }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                    <p class="text-sm font-medium text-gray-700 flex items-center mb-2">
                        <i class="fas fa-phone-alt text-blue-500 mr-2"></i>
                        Teléfono:
                    </p>
                    <p class="text-lg">{{ user.phone }}</p>
                </div>
            </div>
        </div>
        <div v-else class="text-center mt-8">
            <p class="text-lg text-gray-700">No se encontraron detalles del usuario.</p>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link
    },
    props: {
        user: Object
    }
};
</script>

<style scoped>
/* Agrega estilos adicionales aquí si es necesario */
</style>
