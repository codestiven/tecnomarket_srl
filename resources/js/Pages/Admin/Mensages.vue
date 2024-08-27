<template>
    <div class="space-y-8">
        <!-- Título agregado -->
        <h1 class="text-3xl font-bold text-gray-900">Bandeja de mensajes</h1>

        <div v-for="message in messages" :key="message.id"
            class="bg-white shadow-md rounded-lg p-6 transition-transform transform hover:scale-102">
            <div class="flex justify-between items-center border-b pb-4 mb-4">
                <a :href="`/users/${message.id}`" class="text-blue-600 hover:underline font-bold text-xl">
                    {{ message.name }}
                </a>
                <button @click="confirmDelete(message.id)" class="text-red-500 hover:text-red-700 transition-colors">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
            <div class="text-gray-600 mb-4">{{ message.email }}</div>
            <p class="text-gray-800 mb-4">{{ message.message }}</p>
            <p class="text-gray-500 text-sm">{{ formatDate(message.created_at) }}</p>
        </div>

        <div v-if="errorMessage" class="text-red-500">
            {{ errorMessage }}
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';

const messages = ref([]);
const errorMessage = ref('');

const fetchMessages = async () => {
    try {
        const response = await axios.get('/Message');
        messages.value = response.data;
    } catch (error) {
        console.error('Error fetching messages:', error);
    }
};

const confirmDelete = (id) => {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás recuperar este mensaje después de eliminarlo.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, borrar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteMessage(id);
        }
    });
};

const deleteMessage = async (id) => {
    try {
        await axios.delete(`/Message/${id}`);
        messages.value = messages.value.filter(message => message.id !== id);
        Swal.fire(
            'Eliminado!',
            'El mensaje ha sido eliminado.',
            'success'
        );
    } catch (error) {
        console.error('Error deleting message:', error);
        errorMessage.value = 'Hubo un problema al eliminar el mensaje.';
        setTimeout(() => {
            errorMessage.value = '';
        }, 3000);
    }
};

const formatDate = (dateString) => {
    const options = {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
        hour12: true // Cambiado a 12 horas
    };
    return new Date(dateString).toLocaleDateString('es-ES', options);
};

onMounted(() => {
    fetchMessages();
});
</script>

<style scoped>
.transition-transform {
    transition: transform 0.2s ease-in-out;
}

.text-blue-600:hover {
    color: #0056b3;
}

.text-red-500:hover {
    color: #cc0000;
}
</style>
