<script setup>
import { Head } from "@inertiajs/vue3";
import Header from "@/Components/Principales/Header.vue";
import Footer from "@/Components/Principales/Footer.vue";
</script>

<template>

  <Head title="Ayuda" />
  <Header />

  <main>
    <div class="container mx-auto my-8 p-4 bg-white shadow-md rounded-lg">
      <h1 class="text-3xl font-bold text-blue-600 mb-6">Centro de Ayuda</h1>
      <p class="text-lg mb-6 text-gray-700">Encuentra respuestas a las preguntas más frecuentes sobre nuestros productos
        y
        servicios. Si tienes más dudas, no dudes en contactarnos.</p>

      <div id="accordion-collapse" data-accordion="collapse">
        <!-- Question 1 -->
        <h2 id="accordion-collapse-heading-1">
          <button type="button"
            class="flex items-center justify-between w-full p-5 font-medium text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-blue-200 hover:bg-blue-50"
            data-accordion-target="#accordion-collapse-body-1" aria-expanded="true"
            aria-controls="accordion-collapse-body-1">
            <span>¿Dónde estamos ubicados?</span>
            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 5 5 1 1 5" />
            </svg>
          </button>
        </h2>
        <div id="accordion-collapse-body-1" class="hidden" aria-labelledby="accordion-collapse-heading-1">
          <div class="p-5 border border-b-0 border-gray-200 bg-blue-50">
            <p class="mb-2 text-gray-500">Estamos ubicados en la República Dominicana. Nuestra tienda física se
              encuentra
              en la dirección Calle Principal 123, Santo Domingo.</p>
          </div>
        </div>

        <!-- Question 2 -->
        <h2 id="accordion-collapse-heading-2">
          <button type="button"
            class="flex items-center justify-between w-full p-5 font-medium text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-blue-200 hover:bg-blue-50"
            data-accordion-target="#accordion-collapse-body-2" aria-expanded="false"
            aria-controls="accordion-collapse-body-2">
            <span>¿Cómo realizo un pedido?</span>
            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 5 5 1 1 5" />
            </svg>
          </button>
        </h2>
        <div id="accordion-collapse-body-2" class="hidden" aria-labelledby="accordion-collapse-heading-2">
          <div class="p-5 border border-b-0 border-gray-200 bg-blue-50">
            <p class="mb-2 text-gray-500">Para realizar un pedido, navega por nuestro catálogo de productos, selecciona
              los artículos que deseas comprar, y agrégales al carrito. Luego, sigue el proceso de checkout para
              completar
              tu compra.</p>
          </div>
        </div>

        <!-- Question 3 -->
        <h2 id="accordion-collapse-heading-3">
          <button type="button"
            class="flex items-center justify-between w-full p-5 font-medium text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-blue-200 hover:bg-blue-50"
            data-accordion-target="#accordion-collapse-body-3" aria-expanded="false"
            aria-controls="accordion-collapse-body-3">
            <span>¿Cómo puedo rastrear mi pedido?</span>
            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 5 5 1 1 5" />
            </svg>
          </button>
        </h2>
        <div id="accordion-collapse-body-3" class="hidden" aria-labelledby="accordion-collapse-heading-3">
          <div class="p-5 border border-b-0 border-gray-200 bg-blue-50">
            <p class="mb-2 text-gray-500">Una vez que tu pedido haya sido enviado, recibirás un correo electrónico con
              un
              número de seguimiento. Puedes usar este número para rastrear el estado de tu envío en nuestra página web.
            </p>
          </div>
        </div>

        <!-- Question 4 -->
        <h2 id="accordion-collapse-heading-4">
          <button type="button"
            class="flex items-center justify-between w-full p-5 font-medium text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-blue-200 hover:bg-blue-50"
            data-accordion-target="#accordion-collapse-body-4" aria-expanded="false"
            aria-controls="accordion-collapse-body-4">
            <span>¿Puedo cambiar o devolver un producto?</span>
            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 5 5 1 1 5" />
            </svg>
          </button>
        </h2>
        <div id="accordion-collapse-body-4" class="hidden" aria-labelledby="accordion-collapse-heading-4">
          <div class="p-5 border border-b-0 border-gray-200 bg-blue-50">
            <p class="mb-2 text-gray-500">Sí, aceptamos cambios y devoluciones dentro de los 30 días siguientes a la
              compra. Por favor, asegúrate de que el producto esté en su estado original y sin usar. Consulta nuestra
              política de devoluciones para más detalles.</p>
          </div>
        </div>

        <!-- Question 5 -->
        <h2 id="accordion-collapse-heading-5">
          <button type="button"
            class="flex items-center justify-between w-full p-5 font-medium text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-blue-200 hover:bg-blue-50"
            data-accordion-target="#accordion-collapse-body-5" aria-expanded="false"
            aria-controls="accordion-collapse-body-5">
            <span>¿Ofrecen garantía en los productos?</span>
            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 5 5 1 1 5" />
            </svg>
          </button>
        </h2>
        <div id="accordion-collapse-body-5" class="hidden" aria-labelledby="accordion-collapse-heading-5">
          <div class="p-5 border border-b-0 border-gray-200 bg-blue-50">
            <p class="mb-2 text-gray-500">Sí, todos nuestros productos tienen garantía del fabricante. Los términos y
              condiciones de la garantía varían según el producto. Puedes encontrar la información específica en la
              página
              del producto o en el manual de garantía.</p>
          </div>
        </div>

        <!-- Question 6 -->
        <h2 id="accordion-collapse-heading-6">
          <button type="button"
            class="flex items-center justify-between w-full p-5 font-medium text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-blue-200 hover:bg-blue-50"
            data-accordion-target="#accordion-collapse-body-6" aria-expanded="false"
            aria-controls="accordion-collapse-body-6">
            <span>¿Qué métodos de pago aceptan?</span>
            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 5 5 1 1 5" />
            </svg>
          </button>
        </h2>
        <div id="accordion-collapse-body-6" class="hidden" aria-labelledby="accordion-collapse-heading-6">
          <div class="p-5 border border-b-0 border-gray-200 bg-blue-50">
            <p class="mb-2 text-gray-500">Aceptamos una variedad de métodos de pago, incluyendo tarjetas de crédito y
              débito, PayPal, y transferencias bancarias. Puedes seleccionar tu método de pago preferido durante el
              proceso de checkout.</p>
          </div>
        </div>

        <!-- Question 7 -->
        <h2 id="accordion-collapse-heading-7">
          <button type="button"
            class="flex items-center justify-between w-full p-5 font-medium text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-blue-200 hover:bg-blue-50"
            data-accordion-target="#accordion-collapse-body-7" aria-expanded="false"
            aria-controls="accordion-collapse-body-7">
            <span>¿Cómo contacto al servicio de atención al cliente?</span>
            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 5 5 1 1 5" />
            </svg>
          </button>
        </h2>
        <div id="accordion-collapse-body-7" class="hidden" aria-labelledby="accordion-collapse-heading-7">
          <div class="p-5 border border-b-0 border-gray-200 bg-blue-50">
            <p class="mb-2 text-gray-500">Puedes contactar a nuestro servicio de atención al cliente a través del correo
              electrónico soporte@ecommerce.com o llamando al número +1 (809) 123-4567. También puedes usar el
              formulario
              de contacto en nuestra página web.</p>
          </div>
        </div>

        <!-- Question 8 -->
        <h2 id="accordion-collapse-heading-8">
          <button type="button"
            class="flex items-center justify-between w-full p-5 font-medium text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-blue-200 hover:bg-blue-50"
            data-accordion-target="#accordion-collapse-body-8" aria-expanded="false"
            aria-controls="accordion-collapse-body-8">
            <span>¿Qué hago si olvido mi contraseña?</span>
            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 5 5 1 1 5" />
            </svg>
          </button>
        </h2>
        <div id="accordion-collapse-body-8" class="hidden" aria-labelledby="accordion-collapse-heading-8">
          <div class="p-5 border border-b-0 border-gray-200 bg-blue-50">
            <p class="mb-2 text-gray-500">Si olvidas tu contraseña, puedes hacer clic en "Olvidé mi contraseña" en la
              página de inicio de sesión. Luego, sigue las instrucciones para restablecer tu contraseña mediante el
              enlace
              enviado a tu correo electrónico.</p>
          </div>
        </div>

        <!-- Question 9 -->
        <h2 id="accordion-collapse-heading-9">
          <button type="button"
            class="flex items-center justify-between w-full p-5 font-medium text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-blue-200 hover:bg-blue-50"
            data-accordion-target="#accordion-collapse-body-9" aria-expanded="false"
            aria-controls="accordion-collapse-body-9">
            <span>¿Cómo actualizo mi información personal?</span>
            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 5 5 1 1 5" />
            </svg>
          </button>
        </h2>
        <div id="accordion-collapse-body-9" class="hidden" aria-labelledby="accordion-collapse-heading-9">
          <div class="p-5 border border-b-0 border-gray-200 bg-blue-50">
            <p class="mb-2 text-gray-500">Para actualizar tu información personal, inicia sesión en tu cuenta y dirígete
              a
              la sección "Perfil". Aquí podrás modificar tus datos personales y de contacto.</p>
          </div>
        </div>

        <!-- Question 10 -->
        <h2 id="accordion-collapse-heading-10">
          <button type="button"
            class="flex items-center justify-between w-full p-5 font-medium text-gray-500 border border-b-0 border-gray-200 rounded-b-xl focus:ring-4 focus:ring-blue-200 hover:bg-blue-50"
            data-accordion-target="#accordion-collapse-body-10" aria-expanded="false"
            aria-controls="accordion-collapse-body-10">
            <span>¿Ofrecen envío internacional?</span>
            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 5 5 1 1 5" />
            </svg>
          </button>
        </h2>
        <div id="accordion-collapse-body-10" class="hidden" aria-labelledby="accordion-collapse-heading-10">
          <div class="p-5 border border-b-0 border-gray-200 bg-blue-50">
            <p class="mb-2 text-gray-500">Actualmente, solo ofrecemos envíos dentro de la República Dominicana. Estamos
              trabajando para expandir nuestros servicios y ofrecer envío internacional en el futuro.</p>
          </div>
        </div>

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
  background-color: #e0f2fe;
  /* Light blue */
  color: #0284c7;
  /* Dark blue */
}

.accordion-content {
  background-color: #f9fafb;
  /* Light gray */
}
</style>
