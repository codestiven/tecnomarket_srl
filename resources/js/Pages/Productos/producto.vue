<!-- resources/js/Pages/Producto/Show.vue -->

<template>

  <Head :title="producto.nombre" />
  <Header />

  <!-- <div>

    <h1>{{ producto.id }}</h1>
    <h2>{{ producto.nombre }}</h2>
    <p>{{ producto.descripcion }}</p>
    <p>Precio: RD${{ producto.precio }}</p>
    <p>Categoría: {{ producto.categoria_id }}</p>
    <p>Marca: {{ producto.marca_id }}</p>
    <p>Oferta: {{ producto.oferta_id }}</p>
    <p>Creado en: {{ producto.created_at }}</p>
    <p>Actualizado en: {{ producto.updated_at }}</p>
    <img :src="producto.image" alt="Imagen del Producto">


    <div v-if="detallesProducto">
      <h3>Detalles del Producto</h3>
      <p>Color: {{ detallesProducto.color }}</p>
      <p>Peso: {{ detallesProducto.peso }}</p>
      <p>Pantalla: {{ detallesProducto.pantalla }}</p>
      <p>Sistema Operativo: {{ detallesProducto.sistema_operativo }}</p>
      <p>Procesador: {{ detallesProducto.procesador }}</p>
      <p>RAM: {{ detallesProducto.ram }}</p>
      <p>Tarjeta Gráfica: {{ detallesProducto.tarjeta_grafica }}</p>
      <p>Consumo Energético: {{ detallesProducto.consumo_energetico }}W</p>
    </div>
    </div> -->


  <div class="contenedor">
    <div class="left">
      <div class="image">
        <img src="https://m.media-amazon.com/images/I/61ra7K2T5nS._AC_SL1200_.jpg" alt="">
      </div>





    </div>
    <div class="right">

      <div class="principal">
        <div class="nombre">
          <h1> {{ producto.nombre }} </h1>
        </div>

        <div class="info_nombre">
          <div>
            <h1>codigo:</h1> <span>{{ producto.id }}</span>
          </div>
          <div>
            <h1>DELL</h1>
          </div>
        </div>

      </div>

      <div class="linea"></div>
      <div class="precio">
        RD${{ producto.precio }} <span>500</span>
      </div>
      <div class="linea"></div>
      <div class="descripcion">
        <div class="titulo">
          <h1>descripcion</h1> <span> ( {{ likesCount }} me gusta)</span>
        </div>

        <div>Laptop</div>
        <div>Creado en: {{ formattedDate }}</div>

        <div class="descripcion_contenido">

          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
            industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
            scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into
            electronic typesetting, remaining essentially unchanged. </p>

          <div class="flex items-center gap-2">
            <h1 class="text-lg">color</h1> <span class="text-xl font-bold">{{ detallesProducto.color }}</span>
          </div>
        </div>

        <div class="linea "></div>

        <div class="datos_extra">
          <div v-if="detallesProducto.peso">
            <i class="fa-solid fa-weight-hanging"></i> {{ detallesProducto.peso }} kg
          </div>
          <div v-if="detallesProducto.pantalla">
            <i class="fa-solid fa-display"></i> {{ detallesProducto.pantalla }}
          </div>
          <div v-if="detallesProducto.sistema_operativo">
            <i class="fa-solid fa-laptop-code"></i> {{ detallesProducto.sistema_operativo }}
          </div>
        </div>


        <div class="linea"></div>

        <div class="datos_extra">
          <div v-if="detallesProducto.procesador">
            <i class="fa-solid fa-microchip"></i> {{ detallesProducto.procesador }}
          </div>
          <div v-if="detallesProducto.almacenamiento && detallesProducto.tipo_de_almacenamiento">
            <i class="fa-solid fa-hard-drive"></i> {{ detallesProducto.almacenamiento }} GB {{
              detallesProducto.tipo_de_almacenamiento }}
          </div>
          <div v-if="detallesProducto.ram">
            <i class="fa-solid fa-memory"></i> {{ detallesProducto.ram }} GB RAM
          </div>
          <div v-if="detallesProducto.tarjeta_grafica">
            <i class="fa-solid fa-robot"></i>
            {{ detallesProducto.tarjeta_grafica }}
          </div>
        </div>




        <div class="linea"></div>

        <div class="datos_extra">
          <div v-if="detallesProducto.consumo_energetico">
            <i class="fa-solid fa-bolt"></i> {{ detallesProducto.consumo_energetico }} W
          </div>
        </div>

        <div class="buttons">
          <button class="agregar">añadir a carrito</button>
          <div>
            <button> <i class="fa-brands fa-whatsapp"></i> whatsapp</button>
            <button> comprar ahora</button>
          </div>
        </div>


      </div>
    </div>
  </div>


  <Footer />
</template>

<script setup>
import { defineProps, ref, onMounted } from 'vue';
import axios from 'axios';
import { Head, Link } from "@inertiajs/vue3";
import Header from "@/Components/Principales/Header.vue";
import Footer from "@/Components/Principales/Footer.vue";

const props = defineProps({
  producto: Object,
  detallesProducto: Object
});

const likesCount = ref(0); // Variable para almacenar la cantidad de "me gustas"
const formattedDate = ref(""); // Variable para almacenar la fecha formateada

const fetchLikesCount = async (productoId) => {
  try {
    const response = await axios.get(`/guardados/likes/${productoId}`);
    likesCount.value = response.data.likes_count;
  } catch (error) {
    console.error("Error fetching likes count:", error);
  }
};

// Función para formatear la fecha en formato día-mes-año
const formatDate = (dateString) => {
  const date = new Date(dateString);
  const day = String(date.getDate()).padStart(2, '0');
  const month = String(date.getMonth() + 1).padStart(2, '0'); // Los meses empiezan en 0
  const year = date.getFullYear();
  return `${day}/${month}/${year}`;
};

onMounted(() => {
  if (props.producto && props.producto.id) {
    fetchLikesCount(props.producto.id);
  }
  if (props.producto && props.producto.created_at) {
    formattedDate.value = formatDate(props.producto.created_at);
  }
});
</script>


<style scoped>
.linea {
  width: 70%;
  border-bottom: 2px solid #8f8f8f;
  margin: 0;

}

.contenedor {
  display: flex;
  flex-wrap: wrap;
  /* Permite que los hijos se envuelvan */
  padding: 1%;
}

.contenedor>div {
  flex: 1 1 50%;
  box-sizing: border-box;
  padding: 10px;
}

/* left -------------------------------------------------------------------*/
.contenedor .left {
  background-color: aqua;
}

.contenedor .left .image img {
  width: 100%;
  height: 450px;
  object-fit: cover;
  border-radius: 10px;
}


/* right ------------------------------------------------------------------*/
.contenedor .right {
  background-color: antiquewhite;
  height: 100vh;
  display: flex;
  flex-direction: column;

  overflow-y: scroll;
}

.contenedor .right * {
  margin-bottom: 5px;
}

/* .contenedor .right .principal {} */

.contenedor .right .principal .nombre {
  font-size: 1.8rem;
  margin-bottom: 20px;

  font-weight: 700;
}


.contenedor .right .principal .info_nombre {
  display: flex;
  flex-direction: column;
  margin-bottom: 10px;
}

.contenedor .right .principal .info_nombre>div {
  display: flex;
  flex-direction: row;
  gap: 10px;

}

.contenedor .right .principal .info_nombre>div h1 {

  font-weight: 700;
}


.descripcion .titulo {
  display: flex;
  align-items: center;
  text-align: center;
  gap: 10px;

}

.descripcion .titulo h1 {
  font-size: 1.8rem;
  margin-bottom: 20px;
  font-weight: 700;
}

.datos_extra {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
  width: 50%;
  gap: 16px;
  /* Espacio entre los elementos */
}

/* Estilo adicional para los elementos */








.buttons {
  display: flex;
  flex-direction: column;
  gap: 10px;
  /* Ajusta el valor según el espacio que quieras entre los elementos verticales */
}

button.agregar {
  width: 100%;
  padding: 10px;
  background-color: #007bff;
  /* Cambia el color según tu preferencia */
  color: #fff;
  border: none;
  border-radius: 4px;
  font-size: 16px;
  cursor: pointer;
}

.buttons {
  /* padding: 10px; */
  display: flex;
  flex-direction: column;
  gap: 10px;
  width: 60%;
}

button.agregar {
  width: 100%;
  padding: 10px;
  background-color: #007bff;
  /* Cambia el color según tu preferencia */
  color: #fff;
  border: none;
  border-radius: 4px;
  font-size: 16px;
  cursor: pointer;
}

.buttons>div {
  display: flex;
  gap: 10px;
  /* Ajusta el valor según el espacio que quieras entre los botones horizontales */
}

.buttons>div button {
  flex: 1;
  /* Hace que los botones dentro del div ocupen igual espacio */
  padding: 10px;
  border: none;
  border-radius: 4px;
  font-size: 16px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
}

.buttons>div button i {
  margin-right: 5px;
  /* Espacio entre el icono y el texto */
}

.buttons>div button:first-child {
  background-color: #25D366;
  /* Color de fondo para el botón de WhatsApp */
  color: #fff;
}

.buttons>div button:last-child {
  background-color: #28a745;
  /* Color de fondo para el botón de "Comprar ahora" */
  color: #fff;
}



@media (max-width: 768px) {
  .contenedor>div {
    flex: 1 1 100%;
    /* Cada hijo ocupará el 100% en pantallas más pequeñas */
  }

  .buttons>div {
    flex-direction: column;
    gap: 10px;
    /* Ajusta el valor según el espacio que quieras entre los botones en pantallas pequeñas */
  }

  .buttons>div button {
    flex: 1;
    /* Hace que cada botón ocupe el 100% del ancho en pantallas pequeñas */
  }
}
</style>
