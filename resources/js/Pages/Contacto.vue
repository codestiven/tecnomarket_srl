<template>

    <Head title="Contactanos" />
  <Header>  </Header>





  <div class="bg-gray-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Información de Contacto -->
        <div class="bg-white shadow-md rounded-lg p-8">
          <h2 class="text-3xl font-bold text-gray-900 mb-8">Contáctanos</h2>
          <div class="space-y-4">
            <div class="flex items-center">
              <div class="bg-indigo-600 w-10 h-10 flex items-center justify-center rounded-full mr-3">
                <i class="fas fa-phone-alt text-white"></i>
              </div>
              <span class="text-lg text-gray-700">+1 123-456-7890</span>
            </div>
            <div class="flex items-center">
              <div class="bg-indigo-600 w-10 h-10 flex items-center justify-center rounded-full mr-3">
                <i class="fas fa-envelope text-white"></i>
              </div>
              <span class="text-lg text-gray-700">correo@ejemplo.com</span>
            </div>
            <div class="flex items-center">
              <div class="bg-indigo-600 w-10 h-10 flex items-center justify-center rounded-full mr-3">
                <i class="fas fa-map-marker-alt text-white"></i>
              </div>
              <span class="text-lg text-gray-700">123 Calle Principal, Ciudad, País</span>
            </div>
            <div class="flex items-center">
              <div class="bg-indigo-600 w-10 h-10 flex items-center justify-center rounded-full mr-3">
                <i class="fab fa-instagram text-white"></i>
              </div>
              <span class="text-lg text-gray-700">@instagramejemplo</span>
            </div>
          </div>
          <!-- Texto Aleatorio -->
          <div class="mt-8">
            <p class="text-gray-600">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget velit in turpis consectetur euismod. Nulla facilisi. Etiam interdum orci ut lorem feugiat, vitae venenatis felis cursus.
            </p>
          </div>
        </div>

        <!-- Formulario de Contacto y Mapa -->
        <div>
          <div class="bg-white shadow-md rounded-lg p-8 mb-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-8">Envíanos un Mensaje</h3>
            <form @submit.prevent="sendMessage">
              <div class="mb-4">
                <label for="name" class="block text-gray-700">Nombre</label>
                <input type="text" v-model="form.name" id="name" class="mt-1 p-2 w-full border border-gray-300 rounded-md" required>
              </div>
              <div class="mb-4">
                <label for="email" class="block text-gray-700">Correo Electrónico</label>
                <input type="email" v-model="form.email" id="email" class="mt-1 p-2 w-full border border-gray-300 rounded-md" required>
              </div>
              <div class="mb-4">
                <label for="message" class="block text-gray-700">Mensaje</label>
                <textarea v-model="form.message" id="message" class="mt-1 p-2 w-full border border-gray-300 rounded-md" required></textarea>
              </div>
              <div>
                <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">Enviar</button>
              </div>
            </form>
          </div>
          <!-- Mapa -->
          <div class="w-full bg-gray-300 rounded-lg overflow-hidden" style="height: 300px;">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3642.4354205229315!2d-70.10231242505941!3d18.421380972197042!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8ea55f95af918ad5%3A0x17aced50d30659a7!2sTECNOMARKET%20SRL!5e1!3m2!1sen!2sus!4v1723574615675!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>


  <Footer />
</template>



<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { Head, Link } from "@inertiajs/vue3";
import Header from '@/Components/Principales/Header.vue';
import Footer from '@/Components/Principales/Footer.vue';

const form = ref({
  name: '',
  email: '',
  message: ''
});
const errors = ref({});

const sendMessage = async () => {
  try {
    const response = await axios.post('/contact', form.value);
    alert(response.data.success);
    // Reset form fields and errors on successful submission
    form.value.name = '';
    form.value.email = '';
    form.value.message = '';
    errors.value = {};
  } catch (error) {
    // Handle validation errors
    if (error.response && error.response.status === 422) {
      errors.value = error.response.data.errors;
    } else if (error.response && error.response.status === 400) {
      alert(error.response.data.error);
    } else {
      // Handle other errors
      console.error('An unexpected error occurred:', error);
    }
  }
};
</script>