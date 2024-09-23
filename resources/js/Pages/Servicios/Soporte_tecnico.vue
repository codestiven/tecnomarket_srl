<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Header from "@/Components/Principales/Header.vue";
import Footer from "@/Components/Principales/Footer.vue";
import WhatsappButton from "@/Components/WhatsappButton.vue";
</script>

<template>
    <WhatsappButton />

    <Head title="Soporte Técnico" />

    <!-- --------------------------------------------------- header ------------------------------------- -->
    <Header></Header>

    <!-- --------------------------------------------------- Main ------------------------------------- -->
    <main class="bg-gray-50 py-16">
        <!-- Sección de presentación -->
        <section class="container mx-auto px-6 lg:px-16 text-center">
            <h1 class="text-5xl font-extrabold text-gray-800 mb-6 title-animation">
                Soporte Técnico Especializado
            </h1>
            <p class="text-xl text-gray-600 mb-12 subtitle-animation">
                Soluciones rápidas y eficientes para todos tus equipos tecnológicos. Desde la reparación de laptops
                hasta el mantenimiento preventivo de tus dispositivos.
            </p>
        </section>

        <!-- Sección de servicios con imágenes -->
        <section id="servicios" class="container mx-auto px-6 lg:px-16 py-16">
            <div class="flex flex-col lg:flex-row gap-12 items-center service-section">
                <!-- Imagen 1 -->
                <div class="lg:w-1/2 transform transition-transform hover:scale-105 duration-300">
                    <img src="/images/Soporte tecnico.jpg" alt="Soporte técnico"
                        class="rounded-lg shadow-2xl w-full h-auto">
                </div>
                <!-- Descripción de servicios -->
                <div class="lg:w-1/2">
                    <h2 class="text-4xl font-bold text-gray-800 mb-6">
                        Nuestros Servicios
                    </h2>
                    <p class="text-lg text-gray-700 mb-4">
                        Nos especializamos en ofrecer soluciones completas y personalizadas para tus dispositivos
                        tecnológicos. Estos son algunos de nuestros servicios más destacados:
                    </p>
                    <ul class="list-disc pl-6 text-lg text-gray-600 space-y-3">
                        <li>Diagnóstico y reparación de laptops y ordenadores de escritorio.</li>
                        <li>Instalación de software, drivers y actualizaciones del sistema.</li>
                        <li>Mantenimiento preventivo y limpieza de hardware.</li>
                        <li>Optimización del rendimiento de tus dispositivos.</li>
                        <li>Soporte remoto para resolución de problemas menores.</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Sección de compromiso -->
        <section class="bg-blue-600 text-white py-16">
            <div class="container mx-auto px-6 lg:px-16">
                <h2 class="text-4xl font-extrabold text-center mb-8">
                    Nuestro Compromiso
                </h2>
                <div class="lg:flex lg:items-center lg:justify-between">
                    <p class="text-xl text-center lg:text-left mb-8 lg:mb-0">
                        En nuestra organización, estamos comprometidos con ofrecer soluciones rápidas y eficaces para
                        que tus equipos estén siempre en óptimo estado. Nos esforzamos en garantizar un servicio de
                        calidad que se ajuste a tus necesidades.
                    </p>
                </div>
            </div>
        </section>

        <!-- Sección de contacto y más servicios -->
        <section class="container mx-auto px-6 lg:px-16 py-16">
            <div class="flex flex-col lg:flex-row-reverse gap-12 items-center service-section">
                <!-- Imagen 2 -->
                <div class="lg:w-1/2 transform transition-transform hover:scale-105 duration-300">
                    <img src="https://cdn.mos.cms.futurecdn.net/Ajc3ezCTN4FGz2vF4LpQn9-1200-80.jpg"
                        alt="Reparación tecnológica" class="rounded-lg shadow-2xl w-full h-auto">
                </div>
                <!-- Más información -->
                <div class="lg:w-1/2">
                    <h2 class="text-4xl font-bold text-gray-800 mb-6">
                        ¿Por qué Elegirnos?
                    </h2>
                    <p class="text-lg text-gray-700 mb-4">
                        Nuestro equipo de profesionales altamente capacitados está listo para brindarte la mejor
                        asistencia en soporte técnico. Nos destacamos por:
                    </p>
                    <ul class="list-disc pl-6 text-lg text-gray-600 space-y-3">
                        <li>Atención personalizada para cada cliente.</li>
                        <li>Respuesta rápida y soporte en tiempo real.</li>
                        <li>Uso de herramientas avanzadas y tecnología de punta.</li>
                        <li>Garantía de satisfacción en cada reparación.</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Sección de contacto -->
        <section id="contacto" class="bg-gray-100 py-16">
            <div class="container mx-auto px-6 lg:px-16 text-center">
                <h2 class="text-4xl font-bold text-gray-800 mb-8">
                    ¿Necesitas ayuda?
                </h2>
                <p class="text-lg text-gray-600 mb-12">
                    Si tienes alguna pregunta o necesitas más información sobre nuestros servicios, no dudes en
                    contactarnos. ¡Estamos aquí para ayudarte!
                </p>
                <Link :href="route('Contacto')"
                    class="bg-blue-600 text-white py-3 px-8 rounded-lg shadow-lg hover:bg-blue-500 transition duration-300">
                Contáctanos
                </Link>
            </div>
        </section>
    </main>

    <!-- -----------------------------------------------------  Footer ------------------------------------ -->
    <Footer></Footer>
</template>

<style scoped>
/* Animaciones para títulos */
.title-animation {
    animation: fadeInUp 1s ease-out;
}

.subtitle-animation {
    animation: fadeInUp 1.5s ease-out;
}

/* Efecto de escalado al pasar sobre la imagen */
.service-section img {
    transition: transform 0.3s ease;
}

.service-section img:hover {
    transform: scale(1.05);
}

/* Animaciones */
@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }

    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
