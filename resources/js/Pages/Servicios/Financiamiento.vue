<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Header from "@/Components/Principales/Header.vue";
import Footer from "@/Components/Principales/Footer.vue";
import WhatsappButton from "@/Components/WhatsappButton.vue";
</script>

<template>
    <WhatsappButton />

    <Head title="Financiamiento" />

    <!-- --------------------------------------------------- Header ------------------------------------- -->
    <Header />

    <!-- --------------------------------------------------- Main ------------------------------------- -->
    <main >
        <!-- Hero con imagen -->
        <section class="relative bg-white py-32 flex justify-center items-center shadow-lg">
            <div class="absolute inset-0 bg-cover bg-center opacity-50"
                style="background-image: url('/images/Financiamiento-Hero.jpg')"></div>
            <div class="relative z-10 text-center px-8">
                <h1 class="text-5xl font-bold text-gray-800 mb-4">Financiamiento a tu Medida</h1>
                <p class="text-xl text-gray-600">Te ofrecemos diversas opciones para financiar tus productos y obtener
                    el equipo que necesitas sin preocupaciones.</p>
            </div>
        </section>

        <!-- Sección de beneficios -->
        <section class="container mx-auto px-8 py-16">
            <h2 class="text-4xl font-extrabold text-gray-800 text-center mb-12">¿Por qué elegirnos?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                <!-- Opción de tasa baja -->
                <div class="bg-white p-8 shadow-lg rounded-lg text-center">
                    <i class="fa-solid fa-dollar-sign text-6xl text-green-500 mb-4"></i>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Tasas de Interés Bajísimas</h3>
                    <p class="text-lg text-gray-600">
                        Ofrecemos tasas de interés competitivas para que el costo de financiar tu compra sea mínimo.
                    </p>
                </div>

                <!-- Financiamiento flexible -->
                <div class="bg-white p-8 shadow-lg rounded-lg text-center">
                    <i class="fa-solid fa-chart-line text-6xl text-blue-500 mb-4"></i>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Pagos Flexibles</h3>
                    <p class="text-lg text-gray-600">
                        Elige entre plazos de 6, 12 o 18 meses, según lo que más te convenga.
                    </p>
                </div>

                <!-- Atención personalizada -->
                <div class="bg-white p-8 shadow-lg rounded-lg text-center">
                    <i class="fa-solid fa-handshake-angle text-6xl text-orange-500 mb-4"></i>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Atención Personalizada</h3>
                    <p class="text-lg text-gray-600">
                        Nuestro equipo está aquí para asesorarte y brindarte un servicio a la medida de tus necesidades.
                    </p>
                </div>
            </div>
        </section>

        <!-- Sección sobre cómo solicitar financiamiento -->
        <section class="bg-blue-50 py-16">
            <div class="container mx-auto px-8 lg:px-16">
                <h2 class="text-4xl font-extrabold text-gray-800 text-center mb-12">Cómo Solicitar Financiamiento</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <!-- Información de solicitud -->
                    <div class="flex items-center justify-center">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-4">Proceso Simple y Rápido</h3>
                            <p class="text-lg text-gray-600 mb-6">
                                Rellena una breve solicitud en línea y obtén una respuesta en tan solo 24 horas. Puedes
                                financiar cualquier compra mayor a $500.
                            </p>
                            <p class="text-lg text-gray-600">
                                Además, puedes elegir entre diversos métodos de pago, ajustados a tus necesidades y
                                capacidad financiera.
                            </p>
                        </div>
                    </div>

                    <!-- Imagen relacionada -->
                    <div class="flex justify-center">
                        <img src="/images/Financiamiento.jpg" class="rounded-lg shadow-lg"
                            alt="Solicitud de financiamiento" />
                    </div>
                </div>
            </div>
        </section>

        <!-- Llamada a la acción (CTA) -->
        <section class="bg-blue-600 text-white py-16 text-center">
            <div class="container mx-auto px-8">
                <h2 class="text-4xl font-extrabold mb-4">¿Listo para Financiar tu Compra?</h2>
                <p class="text-lg mb-8">Contáctanos hoy mismo y te ayudaremos a encontrar la mejor opción de
                    financiamiento para ti.</p>
                <Link :href="route('Contacto')"
                    class="bg-white text-blue-600 py-3 px-8 rounded-lg shadow-lg hover:bg-gray-200 transition duration-300">
                Contáctanos
                </Link>
            </div>
        </section>
    </main>

    <!-- ----------------------------------------------------- Footer ------------------------------------ -->
    <Footer />
</template>

<style scoped>
/* Fondo y estilo del hero */
.bg-cover {
    background-size: cover;
    background-position: center;
}

/* Hover en los bloques de servicios */


/* Color de fondo del CTA */
.bg-blue-600 {
    background-color: #1d4ed8;
}
</style>
