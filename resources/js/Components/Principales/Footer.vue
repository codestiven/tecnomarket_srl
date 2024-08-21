<template>

    <footer class="bg-white dark:bg-gray-900 mt-6">
        <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
            <div class="md:flex md:justify-between">
                <div class="mb-6 md:mb-0">
                    <a href="/" class="flex items-center">
                        <img src="/images/Logo_white.png" class=" logo" alt="FlowBite Logo" />
                        <h1 class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Tecnomarket
                            SRL</h1>
                    </a>
                    <p class="mt-2 ">Mejoramos y facilitamos cada día<br> la búsqueda y aplicación a pasantías<br> en
                        toda la
                        República Dominicana.</p>
                </div>
                <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                    <!-- <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Resources</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="https://flowbite.com/" class="hover:underline text-white">Flowbite</a>
                            </li>
                            <li>
                                <a href="https://tailwindcss.com/" class="hover:underline text-white">Tailwind CSS</a>
                            </li>
                        </ul>
                    </div> -->
                    <div class="mr-10">
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Información</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <Link :href="route('SobreNosotros')" class="hover:underline text-white">Sobre nosotros
                                </Link>
                            </li>
                            <li>
                                <Link :href="route('Contacto')" class="hover:underline text-white">Contáctanos</Link>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Menu</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <Link :href="route('home')" class="hover:underline text-white">Inicio</Link>
                            </li>
                            <li class="mb-4">
                                <Link :href="route('Productos')" class="hover:underline text-white">Productos</Link>
                            </li>
                            <li class="mb-4">
                                <Link href="/Productos?categoria_id=&marca_id=&en_oferta=solo_ofertas"
                                    class="hover:underline text-white">Ofertas</Link>
                            </li>
                            <li class="mb-4">
                                <Link :href="route('Help')" class="hover:underline text-white">ayuda</Link>
                            </li>


                        </ul>
                    </div>
                </div>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
            <div class="sm:flex sm:items-center sm:justify-between">
                <div class="text-center mt-2 text-white/70">
                    &copy; 2024 Tecno Market SRL. Todos los derechos reservados.
                </div>
                <div class="flex mt-4 sm:justify-center sm:mt-0">
                    <a href="https://www.facebook.com/profile.php?id=100064692615620"
                        class="text-white hover:text-gray-400">
                        <i class="fa-brands fa-facebook"></i>
                        <span class="sr-only">Facebook page</span>
                    </a>
                    <a href="https://www.instagram.com/tecnomarket_srl/?hl=es"
                        class="text-white hover:text-gray-400 ms-5">
                        <i class="fa-brands fa-instagram"></i>
                        <span class="sr-only">Instagram page</span>
                    </a>
                    <a href="https://www.threads.net/@tecnomarket_srl?xmt=AQGzRrsc5zNmYEB1Of8ZortgP22w8Ujzae5CknatfCO5uX8"
                        class="text-white hover:text-gray-400 ms-5">
                        <i class="fa-brands fa-threads"></i>
                        <span class="sr-only">Threads page</span>
                    </a>
                    <a href="https://api.whatsapp.com/message/7KOXF7A2IYJBM1?autoload=1&app_absent=0"
                        class="text-white hover:text-gray-400 ms-5">
                        <i class="fa-brands fa-whatsapp"></i>
                        <span class="sr-only">WhatsApp page</span>
                    </a>
                </div>
            </div>

        </div>
    </footer>

</template>

<script setup>

import Logo from '@/Components/ApplicationLogo.vue';
import { Link } from "@inertiajs/vue3";






</script>

<style scoped>

.logo{
    /* transform: scale(4); */
    width: 10%;
    margin: 10px;

}
footer {
    background-color: var(--primary-color);
    max-width: 100%;
    overflow: hidden;

}

footer p , footer h2 {
    color: white;
}

footer h1 {
    color: white;
    font-size: 25px;
    font-weight: bold;
  

}




/* Estilos para el fondo de la página */
</style>
