<script setup>
import { Head } from "@inertiajs/vue3";
import Header from "@/Components/Principales/Header.vue";
import Footer from "@/Components/Principales/Footer.vue";
import { ref } from "vue";

// Definir las preguntas frecuentes con respuestas genéricas
const faqs = ref([
  {
    question: "¿Cómo funciona la página?",
    answer:
      "Nuestra página ofrece una experiencia fácil y segura para comprar productos de tecnología. Navega por las categorías, añade productos al carrito y procede al pago de manera rápida.",
    open: false,
  },
  {
    question: "¿Dónde está ubicada la tienda Tecnomarket ?",
    answer:
      "Tecnomarket está ubicada en C/ Acuario #7, Madre Vieja Norte, San Cristóbal, República Dominicana.",
    open: false,
  },
  {
    question: "¿Cómo puedo realizar un pedido?",
    answer:
      "Para realizar un pedido, selecciona el producto que deseas, añádelo al carrito de compras y procede a realizar el pago mediante los métodos disponibles.",
    open: false,
  },
  {
    question: "¿Qué métodos de pago aceptan?",
    answer:
      "Aceptamos tarjetas de crédito, débito, PayPal y transferencias bancarias para una mayor flexibilidad en tus compras.",
    open: false,
  },
  {
    question: "¿Cómo puedo rastrear mi pedido?",
    answer:
      "Una vez que completes la compra, recibirás un número de seguimiento que te permitirá rastrear tu pedido desde nuestra plataforma.",
    open: false,
  },
  {
    question: "¿Cuál es el horario de atención?",
    answer:
      "Nuestro horario de atención es de lunes a viernes, de 9:00 AM a 6:00 PM. También puedes contactarnos a través del correo electrónico o WhatsApp.",
    open: false,
  },
]);

// Método para abrir y cerrar las respuestas del acordeón
const toggleFaq = (index) => {
  faqs.value[index].open = !faqs.value[index].open;
};
</script>

<template>

  <Head title="Ayuda" />
  <Header />

  <main class="container mx-auto my-8 p-4 bg-white shadow-md rounded-lg">
    <h1 class="text-3xl font-bold text-blue-600 mb-6">Centro de Ayuda</h1>
    <p class="text-lg mb-6 text-gray-700">
      Encuentra respuestas a las preguntas más frecuentes sobre nuestros productos y servicios. Si tienes más dudas, no
      dudes en contactarnos.
    </p>

    <!-- Acordeón para las preguntas frecuentes -->
    <div v-for="(faq, index) in faqs" :key="index" class="border-b border-gray-300 mb-4">
      <button @click="toggleFaq(index)"
        class="accordion-button w-full text-left font-semibold text-lg py-4 hover:text-blue-700 transition-colors">
        {{ faq.question }}
      </button>
      <div v-if="faq.open" class="accordion-content p-4 text-gray-700">
        {{ faq.answer }}
      </div>
    </div>
  </main>

  <Footer />
</template>

<style scoped>
.container {
  max-width: 800px;
}

.accordion-button {

  color: #0284c7;
  border-radius: 10px;
}

.accordion-content {
  background-color: #f9fafb;
}
</style>
