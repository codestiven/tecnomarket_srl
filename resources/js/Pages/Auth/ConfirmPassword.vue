<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Confirmar Contraseña" />

        <div class="mb-4 text-sm text-blue-600">
            Esta es un área segura de la aplicación. Por favor confirma tu contraseña antes de continuar.
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="password" value="Contraseña" class="text-blue-700" />
                <TextInput id="password" type="password"
                    class="mt-1 block w-full border-blue-300 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                    v-model="form.password" required autocomplete="current-password" autofocus />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="flex justify-end mt-4">
                <PrimaryButton
                    class="ms-4 bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 text-white"
                    :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Confirmar
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
