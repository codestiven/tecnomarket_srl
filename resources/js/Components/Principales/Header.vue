<script setup>
import { ref, onMounted, onBeforeUnmount, watchEffect } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import Logo from "@/Components/ApplicationLogo.vue";
import Busqueda from "@/Components/buscador.vue";
import badges from "@/Components/badges.vue";
import axios from "axios";
import Swal from 'sweetalert2';

function handleClick() {
  axios.get('/user')
    .then(response => {
      window.location.href = route('guardados.index');
    })
    .catch(error => {
      if (error.response && error.response.status === 401) {
        // Si la respuesta es 401, mostrar alerta
        Swal.fire({
          title: 'No estás registrado',
          text: 'Para ver los productos guardados primero debes iniciar sesión.',
          icon: 'warning',
          confirmButtonText: 'OK'
        });
      } else {
        console.error('Error al verificar el estado de autenticación:', error);
      }
    });
}


const open = ref(false);

const props = defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  laravelVersion: String,
  phpVersion: String,
});

// Propiedad reactiva para el tamaño de la pantalla
const isMobile = ref(false);

// Propiedad reactiva para la cantidad de elementos guardados
const guardadosCount = ref(0);

// Propiedad reactiva para la cantidad de elementos en el carrito
const cartCount = ref(0);

// Función para alternar la visibilidad del menú
function toggleMenu() {
  const menu = document.getElementById("navbar-default");
  menu.classList.toggle("hidden");
}

// Función para verificar el tamaño de la pantalla
function checkScreenSize() {
  isMobile.value = window.innerWidth < 1000; // Define tu punto de quiebre aquí (por ejemplo, 768px para móvil)
}

// Función para obtener la cantidad de elementos guardados
async function fetchGuardadosCount() {
  try {
    const response = await axios.get('/guardados/MyLikes');
    if (response.status === 200 && response.data && typeof response.data.guardados_count !== 'undefined') {
      guardadosCount.value = response.data.guardados_count;
    } else {
      guardadosCount.value = 0;
    }
  } catch (error) {
    if (error.response && error.response.status === 401) {
      // Maneja la redirección o el mensaje de error aquí
      console.log('No autorizado. Por favor, inicia sesión.');
    } else {
      console.log('Error al obtener la cantidad de elementos guardados:', error);
    }
    guardadosCount.value = 0;
  }
}

// Función para actualizar la cantidad de elementos en el carrito desde el localStorage
function updateCartCount() {
  const cart = JSON.parse(localStorage.getItem('cart')) || [];
  cartCount.value = cart.length;
}

// Función para manejar la confirmación de cierre de sesión
function confirmLogout(event) {
  event.preventDefault(); // Evita el comportamiento por defecto del enlace

  Swal.fire({
    title: '¿Estás seguro?',
    text: '¿Quieres cerrar sesión?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí, cerrar sesión',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      // Enviar una solicitud POST al endpoint de cierre de sesión
      axios.post('/logout').then(response => {
        // Redirige a la página de inicio o a donde desees después del cierre de sesión
        window.location.href = '/';
      }).catch(error => {
        console.error('Error al cerrar sesión:', error);
      });
    }
  });
}

onMounted(() => {
  // Verificar el tamaño inicial de la pantalla
  checkScreenSize();

  // Agregar listener para verificar el tamaño de la pantalla en el cambio de tamaño de la ventana
  window.addEventListener("resize", checkScreenSize);

  // Obtener la cantidad de elementos guardados al montar el componente
  fetchGuardadosCount();

  // Inicializar la cantidad de elementos en el carrito
  updateCartCount();

  // Observar cambios en el localStorage para actualizar el conteo del carrito
  const observer = new MutationObserver(() => {
    updateCartCount();
  });

  // Configurar el observador para observar el `localStorage`
  observer.observe(document, { attributes: true, childList: true, subtree: true });

  // Limpiar el observador al destruir el componente
  onBeforeUnmount(() => {
    observer.disconnect();
    window.removeEventListener("resize", checkScreenSize);
  });
});
</script>


<template>

  <header>
    <!-- drawer component -->
    <div id="drawer-example"
      class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-80 dark:bg-gray-800"
      tabindex="-1" aria-labelledby="drawer-label">
      <h5 id="drawer-label"
        class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">
        <svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
          viewBox="0 0 20 20">
          <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>Menú
      </h5>
      <button type="button" data-drawer-hide="drawer-example" aria-controls="drawer-example"
        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
        <span class="sr-only">Close menu</span>
      </button>

      <ul class="space-y-4">
        <li>
          <Link :href="route('home')"
            class="text-gray-900 dark:text-gray-400 hover:text-blue-700 dark:hover:text-white">Inicio</Link>
        </li>
        <li>
          <Link :href="route('Productos')"
            class="text-gray-900 dark:text-gray-400 hover:text-blue-700 dark:hover:text-white">Productos</Link>
        </li>
        <li>
          <Link :href="route('Ofertas')"
            class="text-gray-900 dark:text-gray-400 hover:text-blue-700 dark:hover:text-white">Ofertas</Link>
        </li>
        <li>
          <Link :href="route('SobreNosotros')"
            class="text-gray-900 dark:text-gray-400 hover:text-blue-700 dark:hover:text-white">Sobre nosotros</Link>
        </li>
        <li>
          <Link :href="route('Contacto')"
            class="text-gray-900 dark:text-gray-400 hover:text-blue-700 dark:hover:text-white">Contáctanos</Link>
        </li>
      </ul>
    </div>


    <div class="contenido">
      <div class="Logo">
        <Logo />
      </div>

      <div class="buscar">
        <Busqueda />
      </div>

      <div class="Badge">


        <badges class="badges" :badge-number="guardadosCount">
          <button @click="handleClick">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
              <path
                d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
            </svg>
          </button>
          
        </badges>
        <badges class="badges" :badge-number="cartCount">
          <Link :href="route('Cart')">
          <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">

            <path
              d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
          </svg>
          </Link>
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
              <!-- <button
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                type="button" data-drawer-target="drawer-example" data-drawer-show="drawer-example"
                aria-controls="drawer-example">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">

                  <path fill="#ffffff"
                    d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
                </svg>
              </button> -->

              <button
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                type="button">
                <Link :href="route('Productos')"> Productos </Link>
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
                  <Link :href="route('Contacto')"> Contáctanos </Link>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>


      <div class="seccion">
        <div v-if="$page.props.auth.user" class="relative inline-block text-left">
          <button @click="open = !open"
            class="ll flex items-center rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:bg-[#FF2D20]/10 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
            {{ $page.props.auth.user.name }}
            <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
              aria-hidden="true">
              <path fill-rule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                clip-rule="evenodd" />
            </svg>
          </button>
          <div v-if="open" @mouseleave="open = false"
            class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-blue-600 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
            <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
              <Link href="/profile" class="block px-4 py-2 text-sm text-white hover:bg-blue-700" role="menuitem">Perfil
              </Link>
              <Link @click="confirmLogout" class="block px-4 py-2 text-sm text-white hover:bg-blue-700" role="menuitem">
              Cerrar
              sesión

              </Link>
            </div>
          </div>
        </div>

        <div v-else>
          <Link :href="route('login')"
            class="ll rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:bg-[#FF2D20]/10 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
          Inicio de sesión
          </Link>

          <Link :href="route('register')"
            class="ll rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:bg-[#FF2D20]/10 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
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
  z-index: 8;
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
