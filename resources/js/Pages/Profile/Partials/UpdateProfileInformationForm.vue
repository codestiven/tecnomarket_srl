<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    lastname: user.lastname,
    email: user.email,
});

const updateProfile = () => {
    form.patch(route('profile.update'), {
        preserveScroll: true,
        onSuccess: (response) => {
            // Actualiza los datos del formulario con los datos más recientes
            form.name = response.data.name;
            form.lastname = response.data.lastname;
            form.email = response.data.email;
            // Mensaje de éxito
            form.successMessage = 'Perfil actualizado con éxito.';
        },
        onError: () => {
            // Manejo de errores
        },
    });
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Información del Perfil</h2>

            <p class="mt-1 text-sm text-gray-600">
                Actualiza la información de tu cuenta y dirección de correo electrónico.
            </p>
        </header>

        <form @submit.prevent="updateProfile" class="mt-6 space-y-6">
            <div class="flex gap-4">
                <div class="flex-1">
                    <InputLabel for="name" value="Nombre" />
                    <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                        autocomplete="name" />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <div class="flex-1">
                    <InputLabel for="lastname" value="Apellido" />
                    <TextInput id="lastname" type="text" class="mt-1 block w-full" v-model="form.lastname" required
                        autocomplete="lastname" />
                    <InputError class="mt-2" :message="form.errors.lastname" />
                </div>
            </div>

            <div>
                <InputLabel for="email" value="Correo Electrónico" />
                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                    autocomplete="username" />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800">
                    Tu dirección de correo electrónico no está verificada.
                    <Link :href="route('verification.send')" method="post" as="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Haz clic aquí para volver a enviar el correo de verificación.
                    </Link>
                </p>
                <div v-show="status === 'verification-link-sent'" class="mt-2 font-medium text-sm text-green-600">
                    Se ha enviado un nuevo enlace de verificación a tu dirección de correo electrónico.
                </div>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Guardar</PrimaryButton>

                <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                    <p v-if="form.successMessage" class="text-sm text-gray-600">{{ form.successMessage }}</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
