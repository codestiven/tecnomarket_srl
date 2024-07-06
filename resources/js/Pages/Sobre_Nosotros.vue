<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Header from "@/Components/Principales/Header.vue";
import Footer from "@/Components/Principales/Footer.vue";
import Titulo from "@/Components/Titulos.vue";
import Carruser from "@/Components/Unicos/Carrusel.vue";
import boton1 from "@/Components/Boton_principar.vue";
import Destacados from "@/Components/Unicos/Destacados.vue";
import Ofertas from "@/Components/Unicos/Ofertas.vue";
import Mapa from "@/Components/mapa.vue";
</script>

<template>
  <Head title="Sobre Nosotros" />

  <Header />

  <div class="img_principio">
    <img
      src="https://www.shutterstock.com/image-photo/gdynia-poland-may-1-2023-260nw-2297024239.jpg"
      alt=""
    />
  </div>

  <div class="contenido_sobre_nosotros">
    <Titulo titulo="Quienes Somos" />

    <div class="quieneSomos md:flex">
      <div class="md:w-1/2 flex justify-center items-center">
        <img
          src="https://www.shutterstock.com/image-photo/gdynia-poland-may-1-2023-260nw-2297024239.jpg"
          alt=""
        />
      </div>
      <div class="md:w-1/2 flex justify-center p-5 texto_simple">
        <p>
          Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
          Ipsum has been the industry's standard dummy text ever since the 1500s, when an
          unknown printer took a galley of type and scrambled it to make a type specimen
          book. It has survived not only five centuries, but also the leap into electronic
          typesetting, remaining essentially unchanged. It was popularised in the 1960s
          with the release of Letraset sheets containing Lorem Ipsum passages, and more
          recently with desktop publishing software like Aldus PageMaker including
          versions of Lorem Ipsum.
        </p>
      </div>
    </div>

    <Titulo titulo="Compromiso" />

    <div class="quieneSomos md:flex">
      <div class="md:w-1/2 flex justify-center p-5 texto_simple">
        <p>
          Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
          Ipsum has been the industry's standard dummy text ever since the 1500s, when an
          unknown printer took a galley of type and scrambled it to make a type specimen
          book. It has survived not only five centuries, but also the leap into electronic
          typesetting, remaining essentially unchanged. It was popularised in the 1960s
          with the release of Letraset sheets containing Lorem Ipsum passages, and more
          recently with desktop publishing software like Aldus PageMaker including
          versions of Lorem Ipsum.
        </p>
      </div>

      <div class="md:w-1/2 flex justify-center items-center">
        <img
          src="https://www.shutterstock.com/image-photo/gdynia-poland-may-1-2023-260nw-2297024239.jpg"
          alt=""
        />
      </div>
    </div>

    <div class="quieneSomos md:flex">
      <div
        class="md:w-1/2 flex flex-col items-center justify-center p-5 texto_simple text-left Mision"
      >
        <h1>Mision</h1>
        <p>
          Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
          Ipsum has been the industry's standard dummy text ever since the 1500s, when an
          unknown printer took a galley of type and scrambled it to make a type specimen
          book. It has survived not only five centuries, but also the leap into electronic
          typesetting, remaining essentially unchanged. It was popularised in the 1960s
          with the release of Letraset sheets containing Lorem Ipsum passages, and more
          recently with desktop publishing software like Aldus PageMaker including
          versions of Lorem Ipsum.
        </p>
      </div>

      <div
        class="md:w-1/2 flex flex-col items-center justify-center p-5 texto_simple text-left Vision"
      >
        <h1>Vision</h1>
        <p>
          Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
          Ipsum has been the industry's standard dummy text ever since the 1500s, when an
          unknown printer took a galley of type and scrambled it to make a type specimen
          book. It has survived not only five centuries, but also the leap into electronic
          typesetting, remaining essentially unchanged. It was popularised in the 1960s
          with the release of Letraset sheets containing Lorem Ipsum passages, and more
          recently with desktop publishing software like Aldus PageMaker including
          versions of Lorem Ipsum.
        </p>
      </div>
    </div>

    <div class="Cliente">
    <Titulo titulo="Servicio al Cliente" />

    <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
          Ipsum has been the industry's standard dummy text ever since the 1500s, when an
          unknown printer took a galley of type and scrambled it to make a type specimen
          book. It has survived not only five centuries, but also the leap into electronic
          typesetting, remaining essentially unchanged. It was popularised in the 1960s
          with the release of Letraset sheets containing Lorem Ipsum passages, and more
          recently with desktop publishing software like Aldus PageMaker including
          versions of Lorem Ipsum.</p>
    
    
    </div>

    <Mapa />
  </div>
  <Footer />
</template>

<style scoped>
.contenido_sobre_nosotros {
  width: 100%;
  height: auto;
  padding: 0px 100px;
}
.img_principio {
  width: 100%;
  height: auto;

  /* Importante para posicionar el overlay */
}

.img_principio img {
  width: 100%;
  height: 500px;

  object-fit: cover;
  /* Importante para posicionar el overlay */
}

.quieneSomos {
  width: 100%;
  padding: 20px;
}

.quieneSomos img {
  width: 80%;
  padding: 20px;
}

.Mision {
  background-color: var(--primary-color);
  color: white;
  padding: 30px;
  text-align: justify;
}

.Vision {
  background-color: var(--secondary-color);
  color: white;
  padding: 30px;
  text-align: justify;
}

.Mision h1,
.Vision h1 {
  color: #ffffff;
  font-size: 50px;
  font-weight: bold;
  text-align: center;
  margin-bottom: 20px;
}

.Cliente {

  color: rgb(58, 58, 58);
  padding: 25px;
  text-align: justify;

  font-size: 25px;
  font-weight: 700;
  


  text-align: center;

  
}



@media (max-width: 768px) {
  .contenido_sobre_nosotros {
    padding: 0px 1px;
  }

  .contenido_sobre_nosotros *{
    text-align: center;
  }
}
</style>
