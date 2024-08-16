<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    provincias: Array,
});

console.log('Provincias:', props.provincias); // Verificar en la consola

const form = useForm({
    name: '',
    lastname: '',
    email: '',
    password: '',
    password_confirmation: '',
    address: '',
    province_id: null,
    phone: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

// Función para ir hacia atrás en el historial del navegador
const goBack = () => {
    window.history.back();
};
</script>

<template>

    <Head title="Registro" />

    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-900 via-blue-500 to-cyan-400 p-8 relative">

        <!-- Botón "Volver" en la esquina superior izquierda -->
        <button @click="goBack"
            class="absolute top-4 left-4 bg-red-500 text-white hover:bg-red-600 rounded-lg p-2 shadow-md transition-colors">
            ← Volver
        </button>

        <div class="flex flex-col items-center w-full max-w-4xl">
            <!-- Logo Independiente -->

            <!-- Caja del Formulario -->
            <div class="bg-white shadow-2xl rounded-lg p-12 w-full max-w-2xl">
                <h2 class="text-4xl font-bold text-blue-900 mb-12 text-center">Regístrate</h2>

                <form @submit.prevent="submit">
                    <!-- Nombre y Apellido en Horizontal -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div>
                            <label for="name" class="block text-lg font-medium text-blue-900">Nombre</label>
                            <input id="name" type="text" v-model="form.name" required autofocus
                                placeholder="Nombre completo"
                                class="mt-2 block w-full px-4 py-3 border border-blue-300 rounded-lg shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                            <p v-if="form.errors.name" class="mt-2 text-sm text-red-600">{{ form.errors.name }}</p>
                        </div>

                        <div>
                            <label for="lastname" class="block text-lg font-medium text-blue-900">Apellido</label>
                            <input id="lastname" type="text" v-model="form.lastname" required placeholder="Apellido"
                                class="mt-2 block w-full px-4 py-3 border border-blue-300 rounded-lg shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                            <p v-if="form.errors.lastname" class="mt-2 text-sm text-red-600">{{ form.errors.lastname }}
                            </p>
                        </div>
                    </div>

                    <!-- Correo Electrónico -->
                    <div class="mb-8">
                        <label for="email" class="block text-lg font-medium text-blue-900">Correo electrónico</label>
                        <input id="email" type="email" v-model="form.email" required placeholder="ejemplo@dominio.com"
                            class="mt-2 block w-full px-4 py-3 border border-blue-300 rounded-lg shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                        <p v-if="form.errors.email" class="mt-2 text-sm text-red-600">{{ form.errors.email }}</p>
                    </div>

                    <!-- Contraseña y Confirmar Contraseña en Horizontal -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div>
                            <label for="password" class="block text-lg font-medium text-blue-900">Contraseña</label>
                            <input id="password" type="password" v-model="form.password" required placeholder="********"
                                class="mt-2 block w-full px-4 py-3 border border-blue-300 rounded-lg shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                            <p v-if="form.errors.password" class="mt-2 text-sm text-red-600">{{ form.errors.password }}
                            </p>
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-lg font-medium text-blue-900">Confirmar
                                contraseña</label>
                            <input id="password_confirmation" type="password" v-model="form.password_confirmation"
                                required placeholder="********"
                                class="mt-2 block w-full px-4 py-3 border border-blue-300 rounded-lg shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                            <p v-if="form.errors.password_confirmation" class="mt-2 text-sm text-red-600">{{
                                form.errors.password_confirmation }}</p>
                        </div>
                    </div>

                    <!-- Dirección y Teléfono -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div>
                            <label for="address" class="block text-lg font-medium text-blue-900">Dirección</label>
                            <input id="address" type="text" v-model="form.address" placeholder="Dirección"
                                class="mt-2 block w-full px-4 py-3 border border-blue-300 rounded-lg shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                            <p v-if="form.errors.address" class="mt-2 text-sm text-red-600">{{ form.errors.address }}
                            </p>
                        </div>

                        <div>
                            <label for="phone" class="block text-lg font-medium text-blue-900">Teléfono</label>
                            <input id="phone" type="text" v-model="form.phone" placeholder="Teléfono"
                                class="mt-2 block w-full px-4 py-3 border border-blue-300 rounded-lg shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                            <p v-if="form.errors.phone" class="mt-2 text-sm text-red-600">{{ form.errors.phone }}</p>
                        </div>
                    </div>

                    <!-- Provincia -->
                    <div class="mb-8">
                        <label for="province_id" class="block text-lg font-medium text-blue-900">Provincia</label>
                        <select id="province_id"
                            class="mt-2 block w-full px-4 py-3 border border-blue-300 rounded-lg shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                            v-model="form.province_id" required>
                            <option value="" disabled>Seleccione una provincia</option>
                            <option v-for="provincia in provincias" :key="provincia.id" :value="provincia.id">
                                {{ provincia.nombre }}
                            </option>
                        </select>
                        <p v-if="form.errors.province_id" class="mt-2 text-sm text-red-600">{{ form.errors.province_id
                            }}</p>
                    </div>

                    <div class="flex items-center justify-between">
                        <Link href="/login" class="text-sm text-blue-600 hover:underline">
                        ¿Ya tienes una cuenta? Inicia sesión
                        </Link>

                        <button type="submit" :class="{ 'opacity-50': form.processing }" :disabled="form.processing"
                            class="bg-red-600 text-white py-3 px-6 rounded-lg shadow-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Registrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
