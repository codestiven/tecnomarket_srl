<script setup>
import Header from '@/Components/Principales/Header.vue';
import Footer from '@/Components/Principales/Footer.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import OtherUdate from './Partials/OtherUdate.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Header />

    <Head title="Perfil" />

    <div class="py-12 bg-blue-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow-lg rounded-lg border border-blue-200">
                <h2 class="font-semibold text-2xl text-blue-800 leading-tight mb-4">Información del Perfil</h2>
                <UpdateProfileInformationForm :must-verify-email="mustVerifyEmail" :status="status" class="max-w-xl" />
            </div>

            <div class="p-4 sm:p-8 bg-white shadow-lg rounded-lg border border-blue-200">
                <h2 class="font-semibold text-2xl text-blue-800 leading-tight mb-4">Actualizar Contraseña</h2>
                <UpdatePasswordForm class="max-w-xl" />
            </div>

            <div class="p-4 sm:p-8 bg-white shadow-lg rounded-lg border border-blue-200">
                <h2 class="font-semibold text-2xl text-blue-800 leading-tight mb-4">Actualizar Contraseña</h2>
                <OtherUdate class="max-w-xl" />
            </div>

            <div class="p-4 sm:p-8 bg-white shadow-lg rounded-lg border border-blue-200">
                <h2 class="font-semibold text-2xl text-blue-800 leading-tight mb-4">Eliminar Cuenta</h2>
                <DeleteUserForm class="max-w-xl" />
            </div>
        </div>
    </div>

    <Footer />
</template>
