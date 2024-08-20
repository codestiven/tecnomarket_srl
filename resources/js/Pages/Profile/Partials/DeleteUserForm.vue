<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <!-- Botón para eliminar cuenta, debería estar visible -->
        <DangerButton @click="confirmUserDeletion">Eliminar Cuenta</DangerButton>

        <!-- Modal para confirmar eliminación -->
        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6 bg-white rounded shadow-lg">
                <h2 class="text-lg font-medium text-gray-900">
                    ¿Estás seguro de que deseas eliminar tu cuenta?
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Una vez que tu cuenta sea eliminada, todos sus recursos y datos serán eliminados permanentemente.
                    Por favor ingresa tu contraseña para confirmar que deseas eliminar tu cuenta de manera permanente.
                </p>

                <div class="mt-6">
                    <InputLabel for="password" value="Contraseña" class="sr-only" />

                    <TextInput id="password" ref="passwordInput" v-model="form.password" type="password"
                        class="mt-1 block w-full" placeholder="Contraseña" @keyup.enter="deleteUser" />

                    <InputError :message="form.errors.password" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal">Cancelar</SecondaryButton>

                    <DangerButton class="ms-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                        @click="deleteUser">
                        Eliminar Cuenta
                    </DangerButton>
                </div>
            </div>
        </Modal>

        <!-- Contenido adicional de la sección -->
        <header>
            <h2 class="text-lg font-medium text-gray-900">Eliminar Cuenta</h2>

            <p class="mt-1 text-sm text-gray-600">
                Una vez que tu cuenta sea eliminada, todos sus recursos y datos serán eliminados permanentemente. Antes
                de eliminar tu cuenta, por favor descarga cualquier dato o información que desees conservar.
            </p>
        </header>
    </section>
</template>
