<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Header from "@/Components/Principales/Header.vue";
import Footer from "@/Components/Principales/Footer.vue";
import Titulo from "@/Components/Titulos.vue";
import Carruser from "@/Components/Unicos/Carrusel.vue";
import boton1 from "@/Components/Boton_principar.vue";
import Card from "@/Components/Principales/ProductCard.vue";

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
  <Head title="Inicio" />

  <!-- --------------------------------------------------- header ------------------------------------- -->

  <Header></Header>

  <!-- -----------------------------------------------------  carrusel ------------------------------------ -->
  <Carruser></Carruser>
  <!-- -----------------------------------------------------  productos ------------------------------------ -->

  <Titulo
    titulo="productos"
    subtitulo="Todos nuestro productos a solo un click de tus manos"
  />

  <div class="productos">
    <div class="Laptos p-8">
      <a href="#">
        <div class="img">
          <img src="/images/laptos.png" alt="" />
        </div>
        <div class="texto flex justify-end items-center">
          <h1>Laptops</h1>
        </div>
      </a>
    </div>

    <div class="TV">
      <a href="#">
        <div>
          <img src="/images/TV.png" alt="" />
        </div>
        <div class="texto flex justify-end items-center">
          <h1>TVs</h1>
        </div>
      </a>
    </div>
    <div class="accesorios">
      <a href="#">
        <div>
          <img src="/images/accesorios.png" alt="" />
        </div>
        <div class="texto flex justify-end items-center">
          <h1>Aaccesorios</h1>
        </div>
      </a>
    </div>
    <div class="otros flex flex-col md:flex-row items-start">
      <!-- Div con la imagen -->
      <div class="hidden md:flex md:w-1/2 justify-end">
        <img src="/images/dipositivos.png" alt="" class="max-w-full h-auto" />
      </div>

      <!-- Div con el texto -->
      <div class="md:w-1/2">
        <h1 class="text-3xl font-bold mb-4">Otros</h1>
        <p>
          Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
          Ipsum has been the industry's standard dummy text ever since the 1500s, when an
          unknown printer took a galley of type and scrambled it to make a type specimen
          book.
        </p>
        <boton1>Ver mas</boton1>
      </div>

      <!-- Div con la imagen -->
    </div>
  </div>

  <!-- -----------------------------------------------------  Servicios ------------------------------------ -->

  <Titulo titulo="Servicios" />

  <div class="Servicios">
    <div class="div1"></div>
    <div class="div2"></div>
    <div class="div3"></div>
  </div>

  <!-- -----------------------------------------------------  Ofertas ------------------------------------ -->

  <Titulo titulo="Nuevas Ofertas" />

  <div class="Ofertas">
    <div class="cards">
      <Card />
      <Card />
      <Card />
    </div>
  </div>

  <!-- -----------------------------------------------------  motivacion ------------------------------------ -->

  <div class="motivacion">
    <div class="overlay">
      <h1>Estamos aquí para ti</h1>
    </div>
  </div>

  <!-- -----------------------------------------------------  Destacados ------------------------------------ -->

  <Titulo
    titulo="Articulos Destacado"
    subtitulo="Laptop      Accesorios      TV     Mouse   Teclado   audifonos   otros"
  />

  <!-- -----------------------------------------------------  mapa ------------------------------------ -->

  <Titulo titulo="Donde nos encontramos" />

  <iframe
    class="mapa"
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3785.3726697721395!2d-70.10231242505938!3d18.421380972197042!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8ea55f95af918ad5%3A0x17aced50d30659a7!2sTECNOMARKET%20SRL!5e0!3m2!1ses-419!2sdo!4v1719876703382!5m2!1ses-419!2sdo"
    width="600"
    height="450"
    style="border: 0"
    allowfullscreen=""
    loading="lazy"
    referrerpolicy="no-referrer-when-downgrade"
  ></iframe>

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
  padding: 0px 120px;
}

.productos > div {
  background-image: url("/images/fondos_cuadros.jpg");
  text-align: center;
  padding: 20px;
  font-size: 30px;

  border-radius: 40px;

  color: #fff;
  font-size: 35px;
  font-weight: bold;
}

.productos .img img {
  width: 100%;
  object-fit: scale-down;
  max-height: 270px;
}

.productos > .img:hover {
  transform: scale(1.05);
  color: #ffffff;
}

.productos > div:hover img {
  transform: scale(1.3);
  color: #962727;
  font-size: 40px;
}
.productos {
  display: grid;
  grid-template-columns: repeat(3, 1fr); /* Tres columnas */
  grid-template-rows: auto; /* Altura automática según el contenido */
  grid-gap: 20px; /* Espacio entre las celdas */
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
  font-size: 20px;
  font-weight: 100;

  margin-bottom: 20px;
}

.productos .otros img {
  width: 100%;
  object-fit: scale-down;
  transform: scale(1.2) translateX(55px);
}

@media (max-width: 768px) {
  .productos {
    grid-template-columns: 1fr; /* Una sola columna */
    grid-template-rows: auto; /* Altura automática según el contenido */
    grid-gap: 20px; /* Espacio entre las celdas */
    padding: 0 20px; /* Ajuste de padding */
  }

  .productos .Laptos,
  .productos .TV,
  .productos .accesorios,
  .productos .otros {
    grid-area: auto;
    overflow: hidden; /* Resetear las áreas grid */
  }
}

/* Servicios   -----------------------------------------*/
.Servicios {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  grid-template-rows: 1fr;
  grid-column-gap: 60px;
  grid-row-gap: 30px;
  padding: 0px 120px 0px 120px;
}

.Servicios * {
  background-color: rgba(80, 80, 80, 0.8);
  text-align: center;
  padding: 20px;
  font-size: 30px;
  height: 250px;
  border-radius: 40px;
}

.Servicios .div1 {
  grid-area: 1 / 1 / 2 / 3;
}

.Servicios .div2 {
  grid-area: 1 / 3 / 2 / 4;
}

.Servicios .div3 {
  grid-area: 1 / 4 / 2 / 5;
}

/* Ofertas   -----------------------------------------*/
.Ofertas {
  width: 100%;
  height: 500px;

  background: rgb(106, 180, 227);
  background: linear-gradient(
    304deg,
    rgba(106, 180, 227, 1) 0%,
    rgba(81, 122, 167, 1) 100%
  );
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

.motivacion h1 {
  font-size: 70px;
  letter-spacing: 6px;

  font-weight: bold;
  text-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
}

/* mapa -------------- ----------------------------------------- */
.mapa {
  width: 100%;

  margin: 120px 0px 120px 0px;
}


.cards {
  display: grid;
  grid-template-columns: repeat(3, 1fr); /* Tres columnas */
  grid-template-rows: auto; /* Altura automática según el contenido */
  grid-gap: 20px;
  padding: 0 20px;
/* Espacio entre las celdas */
}
</style>
