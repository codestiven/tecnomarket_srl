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
import WhatsappButton from "@/Components/WhatsappButton.vue";
</script>

<template>

  <Head title="Sobre Nosotros" />

  <Header />

  <WhatsappButton></WhatsappButton>

  <main>
    <div class="img_principio">
      <img src="https://www.shutterstock.com/image-photo/gdynia-poland-may-1-2023-260nw-2297024239.jpg"
        alt="Imagen de la tienda TecnoMarket " loading="lazy"  />
    </div>

    <div class="contenido_sobre_nosotros">
      <Titulo titulo="¿Quiénes Somos?" />

      <div class="quieneSomos md:flex">
        <div class="md:w-1/2 flex justify-center items-center">
          <img src="https://www.shutterstock.com/image-photo/gdynia-poland-may-1-2023-260nw-2297024239.jpg"
            alt="Equipo de TecnoMarket " loading="lazy"  />
        </div>
        <div class="md:w-1/2 flex justify-center p-5 texto_simple">
          <p>
            TecnoMarket es una tienda especializada en la venta de laptops a bajo costo, tanto nuevas como usadas.
            Nos ubicamos en Calle Acuario #7, Madre Vieja Norte, Benemérita De San Cristóbal, San Cristóbal, República
            Dominicana. Desde nuestra fundación en febrero de 2015, hemos trabajado incansablemente para convertirnos en
            una opción confiable para estudiantes, profesionales y empresas que buscan soluciones tecnológicas a precios
            accesibles. TecnoMarket se enorgullece de ser una empresa fundada por una mujer emprendedora, cuyo esfuerzo
            ha permitido que la tienda crezca continuamente. Nuestro compromiso es proporcionar productos de alta
            calidad y un servicio al cliente excepcional.
          </p>
        </div>
      </div>

      <Titulo titulo="Compromiso" />

      <div class="quieneSomos md:flex">
        <div class="md:w-1/2 flex justify-center p-5 texto_simple">
          <p>
            En TecnoMarket , nuestro compromiso se basa en ofrecer laptops de alta calidad, tanto nuevas como usadas,
            a los mejores precios del mercado. Entendemos que cada cliente tiene necesidades únicas, por lo que nos
            esforzamos en brindar un servicio personalizado para ayudar a cada persona a encontrar la laptop que mejor
            se ajuste a sus requisitos y presupuesto. Ya sea que necesites una computadora para estudios, trabajo o
            entretenimiento, en TecnoMarket nos aseguramos de que recibas una opción confiable. Nuestro objetivo es
            hacer que la tecnología sea accesible para todos, manteniendo una relación cercana y transparente con
            nuestros clientes.
          </p>
        </div>

        <div class="md:w-1/2 flex justify-center items-center">
          <img src="https://www.shutterstock.com/image-photo/gdynia-poland-may-1-2023-260nw-2297024239.jpg"
            alt="Servicio al cliente TecnoMarket " loading="lazy"  />
        </div>
      </div>

      <div class="quieneSomos md:flex">
        <div class="md:w-1/2 flex flex-col items-center justify-center p-5 texto_simple text-left Mision">
          <h1>Misión</h1>
          <p>
            Nuestra misión en TecnoMarket es proporcionar soluciones tecnológicas accesibles a través de la venta de
            laptops a bajo costo, nuevas y usadas. Creemos que la tecnología debe estar al alcance de todos, y
            trabajamos para asegurar que nuestros productos no solo sean asequibles, sino también de alta calidad. Nos
            esforzamos por empoderar a nuestros clientes ofreciéndoles herramientas tecnológicas que mejoren su vida
            diaria, tanto en el ámbito laboral como en el educativo. Nos comprometemos a ofrecer una atención
            personalizada y productos que cumplan con los más altos estándares, ayudando así a nuestros clientes a
            alcanzar sus metas tecnológicas.
          </p>
        </div>

        <div class="md:w-1/2 flex flex-col items-center justify-center p-5 texto_simple text-left Vision">
          <h1>Visión</h1>
          <p>
            En TecnoMarket , nuestra visión es ser la tienda líder en la venta de laptops a bajo costo en la
            República Dominicana. Nos proyectamos como un negocio confiable, donde nuestros clientes siempre encuentren
            productos tecnológicos de calidad y un servicio al cliente sobresaliente. Queremos expandir nuestra
            presencia en todo el país y ser reconocidos por nuestra innovación, integridad y compromiso con la
            satisfacción del cliente. A medida que crecemos, mantenemos como prioridad seguir ofreciendo laptops tanto
            nuevas como usadas, que respondan a las necesidades de los estudiantes, emprendedores y empresas,
            contribuyendo al avance tecnológico de nuestra comunidad.
          </p>
        </div>
      </div>

      <div class="Cliente">
        <Titulo titulo="Servicio al Cliente" />

        <p>
          En TecnoMarket , creemos firmemente que un excelente servicio al cliente es lo que nos diferencia. Nos
          dedicamos a atender cada consulta de manera rápida y eficiente, brindando soluciones personalizadas para cada
          situación. Ya sea que estés buscando una laptop nueva o usada, nuestro equipo está listo para ofrecerte la
          mejor opción basada en tus necesidades y presupuesto. Nuestro objetivo es que cada cliente se sienta valorado
          y satisfecho con su compra. Nos enorgullece recibir comentarios positivos, lo cual refleja nuestro esfuerzo en
          mantener altos estándares de atención al cliente.
        </p>
      </div>

      <Mapa />
    </div>
  </main>

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
