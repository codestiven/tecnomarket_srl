<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Head, Link } from "@inertiajs/vue3";
import Header from "@/Components/Principales/Header.vue";
import Footer from "@/Components/Principales/Footer.vue";
import Titulo from "@/Components/Titulos.vue";
import Carruser from "@/Components/Unicos/Carrusel.vue";
import boton1 from "@/Components/Boton_principar.vue";
import Mapa from "@/Components/mapa.vue";
import Servicios from "@/Components/Unicos/Servicios.vue";
import Destacados from "@/Components/Unicos/Destacados.vue";
import Ofertas from "@/Components/Unicos/Ofertas.vue";
import WhatsappButton from "@/Components/WhatsappButton.vue";


const showButton = ref(true);

function handleScroll() {
  if (window.scrollY > 100) {
    showButton.value = false;
  } else {
    showButton.value = true;
  }
}

function scrollToPosition() {
  window.scrollTo({
    top: 650,
    behavior: 'smooth'
  });
}

onMounted(() => {
  window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll);
});

defineProps({
  canLogin: {
    type: Boolean,
  },
  canRegister: {
    type: Boolean,
  },
  laravelVersion: {
    type: String,
    required: true,
  },
  phpVersion: {
    type: String,
    required: true,
  },
});

function handleImageError() {
  document.getElementById("screenshot-container")?.classList.add("!hidden");
  document.getElementById("docs-card")?.classList.add("!row-span-1");
  document.getElementById("docs-card-content")?.classList.add("!flex-row");
  document.getElementById("background")?.classList.add("!hidden");
}
</script>

<template>
  <WhatsappButton />

  <Head title="Inicio" />

  <!-- Botón animado -->
  <transition name="fade" @before-enter="beforeEnter" @enter="enter" @leave="leave">
    <div v-if="showButton" class="fixed bottom-4 left-1/2 transform -translate-x-1/2 z-50">
      <div class="flex items-center justify-center">
        <button @click="scrollToPosition"
          class="p-4 bg-blue-600 text-white rounded-full shadow-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-transform duration-300 transform hover:scale-110 animate-bounce">
          <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
      </div>
    </div>
  </transition>

  <!-- --------------------------------------------------- header ------------------------------------- -->
  <Header></Header>

  <!-- -----------------------------------------------------  carrusel ------------------------------------ -->

  <main>
    <Carruser></Carruser>

    <!-- -----------------------------------------------------  productos ------------------------------------ -->
    <Titulo titulo="Catalogo de productos" subtitulo="Todos nuestros productos a solo un click de tus manos" />

    <div class="productos">
      <div class="Laptos p-8">
        <Link href="/Productos?categoria_id=1&marca_id=&en_oferta=">
        <div class="img">
          <img src="/images/laptos.png" alt="" loading="lazy" />
        </div>
        <div class="texto flex justify-end items-center">
          <h3>Laptops</h3>
        </div>
        </Link>
      </div>

      <div class="TV">
        <Link href="/Productos?categoria_id=2&marca_id=&en_oferta=">
        <div>
          <img src="/images/TV.png" alt="" loading="lazy" />
        </div>
        <div class="texto flex justify-end items-center">
          <h3>TVs</h3>
        </div>
        </Link>
      </div>
      <div class="accesorios">
        <Link href="/Productos?categoria_id=3&marca_id=&en_oferta=">
        <div>
          <img src="/images/accesorios.png" alt="" loading="lazy" />
        </div>
        <div class="texto flex justify-end items-center">
          <h3>Accesorios</h3>
        </div>
        </Link>
      </div>
      <div class="otros flex flex-col md:flex-row items-start">
        <!-- Div con la imagen -->
        <div class="hidden md:flex md:w-1/2 justify-end item_img">
          <img src="/images/dipositivos.png" alt="" class="max-w-full h-auto" loading="lazy" />
        </div>

        <!-- Div con el texto -->
        <div class="md:w-1/2 tt">
          <h3 class="text-3xl font-bold mb-4">Otros</h3>
          <p>
            Descubre nuestra variedad de laptops, TVs y accesorios de calidad. Encuentra los mejores productos
            tecnológicos en República Dominicana. ¡No olvides explorar nuestra sección de 'Otros' para ofertas
            exclusivas!
            Calidad y precio insuperables, justo aquí. ¡Compra hoy mismo!
          </p>
          <div class="boton1">
            <boton1>
              <Link href="/Productos?categoria_id=&marca_id=&en_oferta=">Ver más</Link>
            </boton1>
          </div>
        </div>
      </div>
    </div>



    <!-- -----------------------------------------------------  Destacados ------------------------------------ -->

    <Destacados />

    <!-- ----------------------------------------------------- Ofertas ------------------------------------ -->

    <Ofertas />

    <!-- -----------------------------------------------------  Servicios ------------------------------------ -->
    <Servicios />

    <!-- -----------------------------------------------------  motivacion ------------------------------------ -->
    <div class="motivacion">
      <div class="overlay">
        <h3>Estamos aquí para ti</h3>
      </div>
    </div>



    <!-- -----------------------------------------------------  mapa ------------------------------------ -->
    <Titulo titulo="Donde nos encontramos" :mostrarLinea="false" />
    <Mapa />
  </main>
  <!-- -----------------------------------------------------  Footer ------------------------------------ -->
  <Footer></Footer>
</template>






<style scoped>
/* productos   -----------------------------------------*/
.productos {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  grid-template-rows: repeat(2, 1fr);
  grid-column-gap: 50px;
  grid-row-gap: 50px;
  padding: 0px 70px;
}

/* Animación de rebote */
@keyframes bounce {

  0%,
  20%,
  50%,
  80%,
  100% {
    transform: translateY(0);
  }

  40% {
    transform: translateY(-20px);
  }

  60% {
    transform: translateY(-10px);
  }
}

.animate-bounce {
  animation: bounce 2s infinite;
}

/* Animaciones de entrada y salida */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease;

}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}

/* Efecto de rebote en el botón */
@keyframes bounceIn {
  0% {
    transform: scale(0.5);

    opacity: 0;
  }

  50% {
    transform: scale(1.2);

    opacity: 1;
  }

  100% {


    opacity: 1;
  }
}

.fade-enter-active {
  animation: bounceIn 0.5s ease-out;
}

.productos>div {
  background-image: url("/images/fondos_cuadros.jpg");
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
  text-align: center;
  font-size: 30px;
  font-weight: bold;
  padding: 20px;
  border-radius: 40px;
  color: #fff;
}

.productos .img img {
  width: 100%;
  object-fit: scale-down;
  max-height: 270px;
}

.productos>.img:hover {
  transform: scale(1.05);
  color: #ffffff;
}

.productos>div:hover img {
  transform: scale(1.3);
  color: #962727;
  font-size: 40px;
}

.productos {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  /* Tres columnas */
  grid-template-rows: auto;
  grid-gap: 30px;

}

.productos .Laptos {
  grid-area: 1 / 1 / 2 / 2;
}

.productos .TV {
  grid-area: 1 / 2 / 2 / 3;
}

.productos .accesorios {
  grid-area: 1 / 3 / 2 / 4;
}

.productos .otros {
  grid-area: 2 / 1 / 3 / 4;
  text-align: end;
  background-image: url("/images/fondotros.jpg");

}

.productos .otros p {
  font-size: 21px;
  font-weight: 100;

  margin-bottom: 20px;
}

.productos .otros .tt {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
}

/* .item_img {
  
} */

.productos .otros .item_img img {
  width: 100%;
  object-fit: scale-down;
  transform: scale(1.2) translateX(55px);
}

.productos .otros:hover .item_img img {

  transform: scale(1.7) translateX(55px);
}

.productos .otros:hover .tt h3 {

  transform: scale(1.2);
}

@media (max-width: 768px) {
  .productos {
    grid-template-columns: repeat(2, 1fr);

    grid-template-rows: auto;

    grid-gap: 20px;
    /* Espacio entre las celdas */
    padding: 0 20px;
    /* Ajuste de padding */
  }

  .productos .Laptos,
  .productos .TV,
  .productos .accesorios,
  .productos .otros {
    grid-area: auto;
    overflow: hidden;
    /* Resetear las áreas grid */
  }

.productos .otros {
  display: flex;
  align-items: center;
  justify-content: center;
}

.productos .otros h3{
  margin: 0 auto;

}
.productos .otros p {
  margin: 0 auto;

display: none;
}

.productos .otros .boton1 {
  margin: 10px 0;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;

}

.productos .otros a {
  display: inline-block;
  text-decoration: none;

  /* Cambia esto al color que prefieras */
  color: white;
  /* Cambia esto al color del texto que prefieras */
  padding: 0.5rem 1rem;
  border-radius: 0.25rem;
}


}


/* Motivacion   -----------------------------------------*/
.motivacion {
  margin: 100px 0;
  width: 100%;
  height: 400px;
  background-image: url("/images/fondo.jpg");
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  background-attachment: fixed;
  perspective: 1000px;
  position: relative;
  /* Importante para posicionar el overlay */
}

.overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  /* Fondo oscurecido */
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
  color: white;
}

.motivacion h3 {
  font-size: 70px;
  letter-spacing: 6px;

  font-weight: bold;
  text-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
}
</style>
