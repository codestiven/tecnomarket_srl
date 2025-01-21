<template>
    <div class="container mx-auto p-6  flex flex-col">
        <h2 class="text-2xl font-bold mb-4">Gestionar Carrusel</h2>

        <form @submit.prevent="saveCarousel" class="mb-6 bg-white p-4 rounded shadow-md">
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                <input type="text" v-model="form.title" id="title" class="mt-1 block w-full p-2 border rounded-md"
                    :class="{ 'border-red-500': errors.title }" required>
                <span v-if="errors.title" class="text-red-500 text-sm">{{ errors.title }}</span>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea v-model="form.description" id="description" class="mt-1 block w-full p-2 border rounded-md"
                    :class="{ 'border-red-500': errors.description }" required></textarea>
                <span v-if="errors.description" class="text-red-500 text-sm">{{ errors.description }}</span>
            </div>

            <div class="mb-4">
                <label for="link" class="block text-sm font-medium text-gray-700">Enlace (opcional)</label>
                <input type="text" v-model="form.link" id="link" class="mt-1 block w-full p-2 border rounded-md"
                    :class="{ 'border-red-500': errors.link }">
                <span v-if="errors.link" class="text-red-500 text-sm">{{ errors.link }}</span>
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Imagen</label>
                <input type="file" @change="onFileChange" id="image" class="mt-1 block w-full"
                    :class="{ 'border-red-500': errors.image }" accept="image/*">

                <img v-if="previewImage" :src="previewImage" class="mt-2 h-40 w-40 object-cover" alt="Preview"
                 >
                <span v-if="errors.image" class="text-red-500 text-sm">{{ errors.image }}</span>
            </div>

            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Guardar</button>
        </form>

        <div v-for="carousel in carousels" :key="carousel.id" class="bg-white p-4 rounded shadow-md mb-4 flex-1">
            <div class="flex items-center">
                <img :src="`${carousel.image}`" class="h-20 w-20 object-cover mr-4" alt="Imagen Carrusel"
                   >
                <div class="flex-1">
                    <h2 class="text-lg font-bold">{{ carousel.title }}</h2>
                    <p>{{ carousel.description }}</p>
                    <p v-if="carousel.link"><a :href="carousel.link" class="text-blue-500">Enlace</a></p>
                </div>
                <div class="ml-auto">
                    <button @click="editCarousel(carousel)"
                        class="bg-yellow-500 text-white p-2 rounded mr-2">Editar</button>
                    <button @click="deleteCarousel(carousel.id)"
                        class="bg-red-500 text-white p-2 rounded">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
    data() {
        return {
            carousels: [],
            form: {
                id: null,
                title: '',
                description: '',
                link: '',
                image: null,
            },
            previewImage: null,
            errors: {},
        };
    },
    methods: {
        fetchCarousels() {
            axios.get('/carousels').then(response => {
                this.carousels = response.data;
            }).catch(error => {
                Swal.fire('Error', 'No se pudieron cargar los carousels.', 'error');
            });
        },
        saveCarousel() {
            let formData = new FormData();
            formData.append('title', this.form.title);
            formData.append('description', this.form.description);
            formData.append('link', this.form.link);
            if (this.form.image) {
                formData.append('image', this.form.image);
            }

            let request;
            if (this.form.id) {
                request = axios.post(`/carouselss/${this.form.id}`, formData);
            } else {
                request = axios.post('/carousels', formData);
            }

            request.then(response => {
                this.fetchCarousels();
                this.resetForm();
                Swal.fire('Éxito', 'El carousel se guardó correctamente.', 'success');
            }).catch(error => {
                this.errors = error.response.data.errors || {};
                Swal.fire('Error', 'Hubo un problema al guardar el carousel.', 'error');
            });
        },
        editCarousel(carousel) {
            this.form.id = carousel.id;
            this.form.title = carousel.title;
            this.form.description = carousel.description;
            this.form.link = carousel.link;
            this.previewImage = `/storage/${carousel.image}`;
        },
        deleteCarousel(id) {
            axios.delete(`/carousels/${id}`).then(() => {
                this.fetchCarousels();
                Swal.fire('Éxito', 'El carousel se eliminó correctamente.', 'success');
            }).catch(error => {
                Swal.fire('Error', 'Hubo un problema al eliminar el carousel.', 'error');
            });
        },
        onFileChange(event) {
            const file = event.target.files[0];
            this.form.image = file;
            this.previewImage = URL.createObjectURL(file);
        },
        resetForm() {
            this.form = {
                id: null,
                title: '',
                description: '',
                link: '',
                image: null,
            };
            this.previewImage = null;
            this.errors = {};
        },
    },
    mounted() {
        this.fetchCarousels();
    },
};
</script>

<style scoped>
.container {
  width: 100%;
}
</style>
