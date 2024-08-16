<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>

    <Head title="Iniciar sesión" />

    <div
        class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-r from-blue-900 via-blue-500 to-cyan-400">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
            <div class="flex justify-center mb-8">
                <img src="images/logo.png" alt="Logo" class="h-24 w-auto" />
            </div>

            <h2 class="text-3xl font-bold text-center text-blue-900 mb-8">Iniciar sesión</h2>

            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div>
                    <label for="email" class="block text-sm font-medium text-blue-900">Correo electrónico</label>
                    <input id="email" type="email" v-model="form.email" required autofocus autocomplete="username"
                        placeholder="ejemplo@dominio.com"
                        class="mt-2 block w-full px-4 py-2 border border-blue-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    <p v-if="form.errors.email" class="mt-2 text-sm text-red-600">{{ form.errors.email }}</p>
                </div>

                <div class="mt-4">
                    <label for="password" class="block text-sm font-medium text-blue-900">Contraseña</label>
                    <input id="password" type="password" v-model="form.password" required
                        autocomplete="current-password" placeholder="********"
                        class="mt-2 block w-full px-4 py-2 border border-blue-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    <p v-if="form.errors.password" class="mt-2 text-sm text-red-600">{{ form.errors.password }}</p>
                </div>

                <div class="flex items-center mt-4">
                    <input id="remember" type="checkbox" v-model="form.remember"
                        class="h-4 w-4 text-blue-600 border-blue-300 rounded focus:ring-blue-500" />
                    <label for="remember" class="ms-2 text-sm text-blue-900">Recuérdame</label>
                </div>

                <div class="flex items-center justify-between mt-6">
                    <Link v-if="canResetPassword" :href="route('password.request')"
                        class="text-sm text-blue-600 hover:underline">
                    ¿Olvidaste tu contraseña?
                    </Link>

                    <button type="submit" :class="{ 'opacity-50': form.processing }" :disabled="form.processing"
                        class="bg-blue-600 text-white py-2 px-4 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Iniciar sesión
                    </button>
                </div>

                <div class="flex items-center justify-center mt-8">
                    <span class="text-sm text-blue-900">¿No tienes una cuenta?</span>
                    <Link href="/register" class="text-sm text-blue-600 hover:underline ms-2">
                    Regístrate aquí
                    </Link>
                </div>
            </form>
        </div>
    </div>
</template>
