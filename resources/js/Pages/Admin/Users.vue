<template>
    <div class="p-6">
        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Filtrar por nombre</label>
                <input v-model="filters.name" type="text" placeholder="Nombre"
                    class="mt-1 block w-full border rounded p-2" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Filtrar por provincia</label>
                <input v-model="filters.province" type="text" placeholder="Provincia"
                    class="mt-1 block w-full border rounded p-2" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Filtrar por dirección</label>
                <input v-model="filters.address" type="text" placeholder="Dirección"
                    class="mt-1 block w-full border rounded p-2" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Filtrar por email</label>
                <input v-model="filters.email" type="text" placeholder="Email"
                    class="mt-1 block w-full border rounded p-2" />
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="py-2 px-4">ID</th>
                        <th class="py-2 px-4">Nombre</th>
                        <th class="py-2 px-4">Apellido</th>
                        <th class="py-2 px-4">Email</th>
                        <th class="py-2 px-4">Dirección</th>
                        <th class="py-2 px-4">Provincia</th>
                        <th class="py-2 px-4">Teléfono</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in filteredUsers" :key="user.id" @click="viewUserDetails(user.id)"
                        class="cursor-pointer hover:bg-gray-100">
                        <td class="py-2 px-4">{{ user.id }}</td>
                        <td class="py-2 px-4">{{ user.name }}</td>
                        <td class="py-2 px-4">{{ user.lastname }}</td>
                        <td class="py-2 px-4">{{ user.email }}</td>
                        <td class="py-2 px-4">{{ user.address }}</td>
                        <td class="py-2 px-4">{{ user.provincia?.nombre || 'N/A' }}</td>
                        <td class="py-2 px-4">{{ user.phone }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div v-if="selectedUser" class="mt-6 p-4 border border-gray-200 rounded-lg">
            <h2 class="text-xl font-bold mb-4">Detalles del Usuario</h2>
            <p><strong>ID:</strong> {{ selectedUser.id }}</p>
            <p><strong>Nombre:</strong> {{ selectedUser.name }}</p>
            <p><strong>Apellido:</strong> {{ selectedUser.lastname }}</p>
            <p><strong>Email:</strong> {{ selectedUser.email }}</p>
            <p><strong>Dirección:</strong> {{ selectedUser.address }}</p>
            <p><strong>Provincia:</strong> {{ selectedUser.provincia?.nombre || 'N/A' }}</p>
            <p><strong>Teléfono:</strong> {{ selectedUser.phone }}</p>
        </div>
    </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';
import axios from 'axios';

export default {
    data() {
        return {
            users: [],
            selectedUser: null,
            filters: {
                name: '',
                province: '',
                address: '',
                email: ''
            }
        };
    },
    computed: {
        filteredUsers() {
            return this.users.filter(user => {
                return (
                    (!this.filters.name || user.name.toLowerCase().includes(this.filters.name.toLowerCase())) &&
                    (!this.filters.province || (user.provincia && user.provincia.nombre.toLowerCase().includes(this.filters.province.toLowerCase()))) &&
                    (!this.filters.address || user.address.toLowerCase().includes(this.filters.address.toLowerCase())) &&
                    (!this.filters.email || user.email.toLowerCase().includes(this.filters.email.toLowerCase()))
                );
            });
        }
    },
    methods: {
        fetchUserDetails(id) {
            axios.get(`/users/${id}`)
                .then(response => {
                    this.selectedUser = response.data;
                })
                .catch(error => {
                    console.error('Error fetching user details:', error);
                });
        },
        viewUserDetails(id) {
            Inertia.visit(`/users/${id}`);
        }
    },
    mounted() {
        axios.get('/users')
            .then(response => {
                this.users = response.data;
            })
            .catch(error => {
                console.error('Error fetching users:', error);
            });
    }
};
</script>

<style scoped>
/* Puedes agregar estilos adicionales aquí si es necesario */
</style>
