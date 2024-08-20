<script setup>
import { ref, onMounted, Transition } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

// Use the user data from the page props
const user = usePage().props.auth.user;

const addressInput = ref(null);
const phoneInput = ref(null);
const provinceSelect = ref(null);
const showSuccessMessage = ref(false);

// Initialize form with user data
const form = useForm({
    address: user.address || '',
    province_id: user.province_id || null,
    phone: user.phone || '',
});

// Store provinces data
const provinces = ref([]);

// Fetch provinces data from API
const fetchProvinces = async () => {
    const response = await fetch('/api/province');
    provinces.value = await response.json();
};

// Fetch provinces data and set form values
onMounted(() => {
    fetchProvinces();
});

// Function to update additional profile information
const updateOtherProfile = () => {
    form.post(route('profile.updateother'), {
        onSuccess: () => {
            form.reset();
            showSuccessMessage.value = true;
            setTimeout(() => {
                showSuccessMessage.value = false;
            }, 3000); // Hide message after 3 seconds

            // Optionally, you can focus on a field if there was an error
            if (form.errors.address) {
                addressInput.value.focus();
            }
            if (form.errors.phone) {
                phoneInput.value.focus();
            }
            if (form.errors.province_id) {
                provinceSelect.value.focus();
            }
        },
        onError: () => {
            // Handle form errors
            if (form.errors.address) {
                addressInput.value.focus();
            }
            if (form.errors.phone) {
                phoneInput.value.focus();
            }
            if (form.errors.province_id) {
                provinceSelect.value.focus();
            }
        },
    });
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Información Adicional del Perfil</h2>

            <p class="mt-1 text-sm text-gray-600">
                Actualiza tu dirección, provincia y número de teléfono.
            </p>
        </header>

        <form @submit.prevent="updateOtherProfile" class="mt-6 space-y-6">
            <div>
                <InputLabel for="address" value="Dirección" />
                <TextInput id="address" ref="addressInput" v-model="form.address" type="text" class="mt-1 block w-full"
                    placeholder="Dirección" />
                <InputError class="mt-2" :message="form.errors.address" />
            </div>

            <div>
                <InputLabel for="province_id" value="Provincia" />
                <select id="province_id" ref="provinceSelect" v-model="form.province_id"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Seleccione una provincia</option>
                    <option v-for="provincia in provinces" :key="provincia.id" :value="provincia.id">
                        {{ provincia.nombre }}
                    </option>
                </select>
                <InputError class="mt-2" :message="form.errors.province_id" />
            </div>

            <div>
                <InputLabel for="phone" value="Teléfono" />
                <TextInput id="phone" ref="phoneInput" v-model="form.phone" type="text" class="mt-1 block w-full"
                    placeholder="Teléfono" />
                <InputError class="mt-2" :message="form.errors.phone" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Guardar Información Adicional</PrimaryButton>

                <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                    <p v-if="showSuccessMessage" class="text-sm text-gray-600">Guardado.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
