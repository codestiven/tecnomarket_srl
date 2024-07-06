<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import Logo from "@/Components/ApplicationLogo.vue";
import Busqueda from "@/Components/buscador.vue";
import badges from "@/Components/badges.vue";

const props = defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  laravelVersion: String,
  phpVersion: String,
});

// Propiedad reactiva para el tamaño de la pantalla
const isMobile = ref(false);

// Función para alternar la visibilidad del menú
function toggleMenu() {
  const menu = document.getElementById("navbar-default");
  menu.classList.toggle("hidden");
}

// Función para verificar el tamaño de la pantalla
function checkScreenSize() {
  isMobile.value = window.innerWidth < 1000; // Define tu punto de quiebre aquí (por ejemplo, 768px para móvil)
}

onMounted(() => {
  // Verificar el tamaño inicial de la pantalla
  checkScreenSize();

  // Agregar listener para verificar el tamaño de la pantalla en el cambio de tamaño de la ventana
  window.addEventListener("resize", checkScreenSize);
});

onBeforeUnmount(() => {
  // Eliminar listener al destruir el componente
  window.removeEventListener("resize", checkScreenSize);
});
</script>

<template>
  <header>
    <!-- drawer component -->
    <div
      id="drawer-example"
      class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-80 dark:bg-gray-800"
      tabindex="-1"
      aria-labelledby="drawer-label"
    >
      <h5
        id="drawer-label"
        class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400"
      >
        <svg
          class="w-4 h-4 me-2.5"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="currentColor"
          viewBox="0 0 20 20"
        >
          <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"
          /></svg
        >Info
      </h5>
      <button
        type="button"
        data-drawer-hide="drawer-example"
        aria-controls="drawer-example"
        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white"
      >
        <svg
          class="w-3 h-3"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 14 14"
        >
          <path
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
          />
        </svg>
        <span class="sr-only">Close menu</span>
      </button>

      <p class="mb-6 text-sm text-gray-500 dark:text-gray-400">
        Supercharge your hiring by taking advantage of our
        <a href="#" class="text-blue-600 underline dark:text-blue-500 hover:no-underline"
          >limited-time sale</a
        >
        for Flowbite Docs + Job Board. Unlimited access to over 190K top-ranked candidates
        and the #1 design job board.
      </p>
      <div class="grid grid-cols-2 gap-4">
        <a
          href="#"
          class="px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
          >Learn more</a
        >
        <a
          href="#"
          class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
          >Get access
          <svg
            class="rtl:rotate-180 w-3.5 h-3.5 ms-2"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 14 10"
          >
            <path
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M1 5h12m0 0L9 1m4 4L9 9"
            /></svg
        ></a>
      </div>
    </div>

    <div class="contenido">
      <div class="Logo">
        <Logo />
      </div>

      <div class="buscar">
        <Busqueda />
      </div>

      <div class="Badge">
        <badges class="badges" :badge-number="5">
          <svg
            class="w-5 h-5"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 512 512"
          >
            <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
            <path
              d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"
            />
          </svg>
        </badges>
        <badges class="badges" :badge-number="3">
          <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
            <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
            <path
              d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"
            />
          </svg>
        </badges>
      </div>
    </div>

    <nav>
      <div class="links">
        <!-- drawer init and toggle -->

        <div class="enlaces">
          <div class="text-center"></div>
          <div>
            <div v-if="isMobile" class="flex items-center justify-center">
              <button
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                type="button"
                data-drawer-target="drawer-example"
                data-drawer-show="drawer-example"
                aria-controls="drawer-example"
              >
                <svg
                  class="w-5 h-5"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 448 512"
                >
                  <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                  <path
                    fill="#ffffff"
                    d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"
                  />
                </svg>
              </button>
            </div>
            <div v-else>
              <ul>
                <li>
                  <Link :href="route('home')"> Inicio </Link>
                </li>
                <li>
                  <Link :href="route('Productos')"> Productos </Link>
                </li>
                <li>
                  <Link :href="route('Ofertas')"> Ofertas </Link>
                </li>

                <li>
                  <Link :href="route('SobreNosotros')"> Sobre nosotros </Link>
                </li>
                <li>
                  <Link :href="route('Contacto')"> Contacto </Link>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="seccion">
        <Link
          v-if="$page.props.auth.user"
          :href="route('dashboard')"
          class="ll rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:bg-[#FF2D20]/10 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
        >
          Productos
        </Link>

        <div v-else>
          <Link
            :href="route('login')"
            class="ll rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:bg-[#FF2D20]/10 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
          >
            Inicio de sesion
          </Link>

          <Link
            :href="route('register')"
            class="ll rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:bg-[#FF2D20]/10 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
          >
            Registro
          </Link>
        </div>
      </div>
    </nav>
  </header>
  <div class="placeholder"></div>
</template>

<style scoped>

.placeholder {
  height: 125px;
  width: 100%;
}
header {
  width: 100%;
  height: auto;
  position: fixed;
  z-index: 10000000000;
  margin-bottom: 100px;
}

.badges svg {
  transform: scale(1.5);
  fill: white;
}

.Badge {
  width: 120px;
  height: 100px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.contenido {
  background-color: var(--primary-color);
  width: 100%;
  height: 75px;

  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0% 3% 0% 3%;
}

.contenido .buscar {
  width: 50%;
}

.Logo {
  width: 70px;
}

/* nav----------------------------------------------------------------------------------------------------- */
nav {
  background-color: var(--secondary-color);
  width: 100%;
  height: 50px;

  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0% 3% 0% 3%;
}

@media (max-width: 768px) {
  .contenido .buscar {
    display: none;
    /* Oculta el elemento buscar en pantallas más pequeñas */
  }
}

/* Links */
.enlaces ul {
  list-style: none;
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.enlaces ul li {
  margin: 0 25px;
  color: #fff;
  text-decoration: none;

  font-size: 20px;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;

  transition: all 0.1s ease;
}

.enlaces ul li:hover {
  transform: scale(1.1);
  
}

.enlaces ul li:active {
  color: rgb(0, 33, 180);
  transition: all 0s ease;
}

.seccion * {
  text-decoration: none;
  font-weight: 500;
  font-size: 20px;
  color: #fff;
}
</style>
