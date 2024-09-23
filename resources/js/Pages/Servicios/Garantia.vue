<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Header from "@/Components/Principales/Header.vue";
import Footer from "@/Components/Principales/Footer.vue";
import WhatsappButton from "@/Components/WhatsappButton.vue";
</script>

<template>
    <WhatsappButton />

    <Head title="Garantía" />

    <!-- --------------------------------------------------- header ------------------------------------- -->
    <Header></Header>

    <!-- --------------------------------------------------- Main ------------------------------------- -->
    <main>
        <!-- Sección de Hero -->
        <section class="relative bg-gray-800 text-white py-32">
            <div class="absolute inset-0 bg-cover bg-center opacity-40"
                style="background-image: url('/images/Garantia.jpg')"></div>
            <div class="relative container mx-auto px-6 lg:px-16 text-center">
                <h1 class="text-6xl font-extrabold title-animation">Garantía y Servicio de Calidad</h1>
                <p class="text-xl mt-4 subtitle-animation">
                    Ofrecemos una garantía completa para asegurar la satisfacción de nuestros clientes. Tus productos
                    están protegidos con nosotros.
                </p>
            </div>
        </section>

        <!-- Sección de detalles de garantía -->
        <section class="container mx-auto px-6 lg:px-16 py-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                <!-- Garantía de reparación -->
                <div
                    class="bg-white p-8 shadow-lg rounded-lg transform transition-transform hover:scale-105 duration-300">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Garantía de Reparación</h3>
                    <p class="text-lg text-gray-600 mb-6">
                        Ofrecemos hasta 6 meses de garantía en todas las reparaciones realizadas por nuestro equipo de
                        expertos. Si el problema persiste, lo resolvemos sin costo adicional.
                    </p>
                </div>

                <!-- Garantía de reemplazo -->
                <div
                    class="bg-white p-8 shadow-lg rounded-lg transform transition-transform hover:scale-105 duration-300">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Garantía de Reemplazo</h3>
                    <p class="text-lg text-gray-600 mb-6">
                        Si tu dispositivo no se puede reparar, ofrecemos un reemplazo completo o la devolución del costo
                        de tu equipo, dependiendo de las condiciones del servicio.
                    </p>
                </div>

                <!-- Cobertura extendida -->
                <div
                    class="bg-white p-8 shadow-lg rounded-lg transform transition-transform hover:scale-105 duration-300">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Cobertura Extendida</h3>
                    <p class="text-lg text-gray-600 mb-6">
                        Puedes adquirir una extensión de garantía para proteger tus dispositivos por hasta 2 años
                        adicionales, cubriendo problemas mecánicos y de software.
                    </p>
                </div>
            </div>
        </section>

        <!-- Sección de proceso de garantía -->
        <section class="bg-gray-100 py-20">
            <div class="container mx-auto px-6 lg:px-16 text-center">
                <h2 class="text-4xl font-extrabold text-gray-800 mb-12">¿Cómo funciona nuestra garantía?</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                    <!-- Paso 1 -->
                    <div
                        class="bg-white p-8 shadow-lg rounded-lg transform transition-transform hover:scale-105 duration-300">
                        <div class="text-6xl text-blue-600 mb-4">1</div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Contacto</h3>
                        <p class="text-lg text-gray-600">
                            En caso de problemas con tu equipo, contáctanos a través de nuestra página de soporte
                            técnico o acude directamente a una de nuestras tiendas autorizadas.
                        </p>
                    </div>

                    <!-- Paso 2 -->
                    <div
                        class="bg-white p-8 shadow-lg rounded-lg transform transition-transform hover:scale-105 duration-300">
                        <div class="text-6xl text-blue-600 mb-4">2</div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Diagnóstico</h3>
                        <p class="text-lg text-gray-600">
                            Nuestro equipo evaluará tu dispositivo para determinar si el problema está cubierto por la
                            garantía y proceder con el mejor plan de acción.
                        </p>
                    </div>

                    <!-- Paso 3 -->
                    <div
                        class="bg-white p-8 shadow-lg rounded-lg transform transition-transform hover:scale-105 duration-300">
                        <div class="text-6xl text-blue-600 mb-4">3</div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Reparación/Reemplazo</h3>
                        <p class="text-lg text-gray-600">
                            Una vez diagnosticado el problema, repararemos tu equipo o lo reemplazaremos según lo que
                            cubra tu garantía.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sección de contacto -->
        <section class="container mx-auto px-6 lg:px-16 py-20 text-center">
            <h2 class="text-4xl font-extrabold text-gray-800 mb-8">¿Tienes dudas sobre tu garantía?</h2>
            <p class="text-lg text-gray-600 mb-12">
                Si necesitas más información sobre las condiciones de tu garantía o cómo hacerla válida, no dudes en
                contactarnos.
            </p>
            <Link :href="route('Contacto')"
                class="bg-blue-600 text-white py-3 px-8 rounded-lg shadow-lg hover:bg-blue-500 transition duration-300">
            Contáctanos
            </Link>
        </section>
    </main>

    <!-- -----------------------------------------------------  Footer ------------------------------------ -->
    <Footer></Footer>
</template>

<style scoped>
/* Animaciones para el título principal */
.title-animation {
    animation: fadeInDown 1s ease-out;
}

.subtitle-animation {
    animation: fadeInUp 1.5s ease-out;
}

/* Efecto de escala en tarjetas */
section div:hover {
    transform: scale(1.05);
}

/* Fondo del hero */
.bg-cover {
    background-size: cover;
    background-position: center;
}

/* Animaciones */
@keyframes fadeInDown {
    0% {
        opacity: 0;
        transform: translateY(-20px);
    }

    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

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
