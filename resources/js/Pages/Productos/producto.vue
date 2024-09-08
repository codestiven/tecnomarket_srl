<template>

  <Head :title="producto.nombre" />
  <Header />

  <div class="contenedor">
    <div class="left">
      <div class="image">
        <img :src="producto.image" :alt="producto.nombre" loading="lazy"  />
      </div>
    </div>
    <div class="right">
      <div class="principal">
        <div class="nombre">
          <h1>{{ producto.nombre }}</h1>
        </div>
        <div class="info_nombre">
          <div>
            <h1>codigo:</h1> <span>{{ producto.id }}</span>
          </div>
          <div>
            <h1>{{ producto.marca ? producto.marca.nombre : 'Desconocida' }}</h1>
          </div>
        </div>
      </div>

      <div class="linea"></div>
      <!-- Mostrar solo cuando no hay oferta -->
      <div class="precio" v-if="!producto.es_oferta">
        <h1>RD$ {{ producto.precio ? Number(producto.precio).toLocaleString() : 'Desconocido' }}</h1>
      </div>

      <!-- Mostrar solo cuando hay oferta -->
      <div class="precio" v-else>
        <h1>RD$ {{ producto.oferta && producto.oferta.precio_oferta ?
          Number(producto.oferta.precio_oferta).toLocaleString() : 'Desconocido' }}</h1>
        <span>RD$ {{ producto.precio ? Number(producto.precio).toLocaleString() : 'Desconocido' }}</span>
      </div>

      <div class="linea"></div>
      <div class="descripcion">
        <div class="titulo">
          <h1>descripcion</h1> <span> ( {{ likesCount }} me gusta)</span>
        </div>
        <div class="subtitulo">{{ producto.categoria ? producto.categoria.nombre : 'Desconocida' }}</div>
        <div class="fecha">Creado en: <span>{{ formattedDate }}</span></div>

        <div class="descripcion_contenido">
          <p>{{ producto.descripcion ? producto.descripcion : 'No disponible' }} </p>
          <div class="flex items-center gap-2 my-4">
            <h1 class="text-lg font-medium text-gray-700">Color</h1>
            <span class="text-xl font-bold text-black-600">{{ detallesProducto && detallesProducto.color ?
              detallesProducto.color : 'Desconocido' }}</span>
          </div>
        </div>

        <div class="linea"></div>

        <div class="datos_extra">
          <div v-if="detallesProducto && detallesProducto.peso">
            <i class="fa-solid fa-weight-hanging"></i> {{ detallesProducto.peso }} kg
          </div>
          <div v-if="detallesProducto && detallesProducto.pantalla">
            <i class="fa-solid fa-display"></i> {{ detallesProducto.pantalla }}
          </div>
          <div v-if="detallesProducto && detallesProducto.sistema_operativo">
            <i class="fa-solid fa-laptop-code"></i> {{ detallesProducto.sistema_operativo }}
          </div>
        </div>

        <div class="linea"></div>

        <div class="datos_extra">
          <div v-if="detallesProducto && detallesProducto.procesador">
            <i class="fa-solid fa-microchip"></i> {{ detallesProducto.procesador }}
          </div>
          <div v-if="detallesProducto && detallesProducto.almacenamiento && detallesProducto.tipo_de_almacenamiento">
            <i class="fa-solid fa-hard-drive"></i> {{ detallesProducto.almacenamiento }} GB {{
            detallesProducto.tipo_de_almacenamiento }}
          </div>
          <div v-if="detallesProducto && detallesProducto.ram">
            <i class="fa-solid fa-memory"></i> {{ detallesProducto.ram }} GB RAM
          </div>
          <div v-if="detallesProducto && detallesProducto.tarjeta_grafica">
            <i class="fa-solid fa-robot"></i> {{ detallesProducto.tarjeta_grafica }}
          </div>
        </div>

        <div class="linea"></div>

        <div class="datos_extra">
          <div v-if="detallesProducto && detallesProducto.consumo_energetico">
            <i class="fa-solid fa-bolt"></i> {{ detallesProducto.consumo_energetico }} W
          </div>
        </div>

        <div class="buttons">
          <button class="agregar" @click="handleAddToCart">
            {{ isInCart ? 'Añadido' : 'Añadir a carrito' }}
          </button>
          <div>
            <button @click="whatsappAction"> <i class="fa-brands fa-whatsapp"></i> whatsapp</button>
            <button @click="accountAction"> comprar ahora</button>
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
import { Head } from "@inertiajs/vue3";
import Header from "@/Components/Principales/Header.vue";
import Footer from "@/Components/Principales/Footer.vue";
import Swal from 'sweetalert2';


const props = defineProps({
  producto: {
    type: Object,
    default: () => ({
      id: null,
      nombre: "",
      descripcion: "",
      precio: null,
      categoria: null,
      marca: null,
      image: "",
      created_at: null
    })
  },
  detallesProducto: {
    type: Object,
    default: () => ({
      color: 'Desconocido',
      peso: null,
      pantalla: null,
      sistema_operativo: null,
      procesador: null,
      almacenamiento: null,
      tipo_de_almacenamiento: null,
      ram: null,
      tarjeta_grafica: null,
      consumo_energetico: null
    })
  }
});


const isInCart = ref(false);
const likesCount = ref(0); // Variable para almacenar la cantidad de "me gustas"
const formattedDate = ref(""); // Variable para almacenar la fecha formateada

const fetchLikesCount = async (productoId) => {
  if (!productoId) return; // Salir si productoId es nulo
  try {
    const response = await axios.get(`/guardados/likes/${productoId}`);
    likesCount.value = response.data.likes_count;
  } catch (error) {
    console.error("Error fetching likes count:", error);
  }
};

// Función para formatear la fecha en formato día-mes-año
const formatDate = (dateString) => {
  if (!dateString) return ''; // Asegúrate de que dateString no sea nulo
  const date = new Date(dateString);
  const day = String(date.getDate()).padStart(2, '0');
  const month = String(date.getMonth() + 1).padStart(2, '0'); // Los meses empiezan en 0
  const year = date.getFullYear();
  return `${day}/${month}/${year}`;
};


const addToCart = (productoId) => {
  let cart = JSON.parse(localStorage.getItem('cart')) || [];

  // Verificar si el producto ya está en el carrito
  const index = cart.indexOf(productoId);

  if (index === -1) {
    // Si no está en el carrito, agregarlo
    cart.push(productoId);
    localStorage.setItem('cart', JSON.stringify(cart));

    Swal.fire({
      icon: 'success',
      title: 'Éxito',
      text: 'Producto agregado al carrito correctamente'
    });
  } else {
    // Si ya está en el carrito, quitarlo
    cart.splice(index, 1);
    localStorage.setItem('cart', JSON.stringify(cart));

    Swal.fire({
      icon: 'success',
      title: 'Éxito',
      text: 'Producto eliminado del carrito correctamente'
    });
  }

  // Actualizar el estado de isInCart después de modificar el carrito
  updateCartStatus(productoId);
};

const updateCartStatus = (productoId) => {
  const cart = JSON.parse(localStorage.getItem('cart')) || [];
  isInCart.value = cart.includes(productoId);
};


const whatsappAction = () => {
  // Obtén los detalles del producto
  const productName = props.producto.nombre;
  const productCategory = props.producto.categoria.nombre;
  const productPrice = props.producto.precio;

  // Construye el mensaje con formato en negrita
  const message = `Saludos, estoy interesado en comprar un/una *${productCategory}* con el producto llamado *${productName}* con el precio de RD$ ${productPrice}. ¿Está disponible?`;

  // Construye la URL de WhatsApp
  const phoneNumber = '18098719279'; // Número de teléfono de la empresa (incluye el prefijo internacional)
  const encodedMessage = encodeURIComponent(message);
  const url = `https://wa.me/${phoneNumber}?text=${encodedMessage}`;

  // Abre el enlace en una nueva ventana
  window.open(url, '_blank');

  // Muestra una alerta usando SweetAlert2 y cierra el popup
  Swal.fire({
    title: 'Producto Comprado',
    text: `El producto comprado es ${productName}`,
    icon: 'info',
    confirmButtonText: 'Ok'
  }).then(() => {
    Swal.close(); // Cierra el popup de SweetAlert2 después de hacer clic en el botón 'Ok'
  });
};



const accountAction = async () => {
  try {

    const response = await axios.post('/pedidos', {
      producto_id: props.producto.id
    });


    Swal.fire({
      icon: 'success',
      title: 'Éxito',
      html: 'El producto comprado es <strong>' + props.producto.nombre + '</strong>',
      footer: 'Nos pondremos en contacto contigo pronto.',
      willClose: () => {
        Inertia.visit('/'); // Redirige a la página de inicio usando Inertia.js
      }
    });


    // Limpiar el estado guardado en localStorage
    localStorage.removeItem('pendingOrder');

  } catch (error) {
    if (error.response && error.response.status === 401) {
      // Guardar la información del pedido en localStorage
      localStorage.setItem('pendingOrder', JSON.stringify({
        producto_id: props.producto.id
      }));

      // Redirigir al usuario a la página de registro
      window.location.href = '/register'; // Cambia a la ruta de registro adecuada
    } else if (error.response && error.response.status === 400) {
      // Error en la creación del pedido
      Swal.fire({
        icon: 'warning',
        title: 'Advertencia',
        text: 'Ya has comprado este producto anteriormente.',
        footer: 'Nos pondremos en contacto con contigo pronto.'
      });
    } else {
      // Otros errores
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Hubo un error al crear el pedido.',
      });
    }
  }
};










onMounted(() => {
  if (props.producto && props.producto.id) {
    fetchLikesCount(props.producto.id);
  }
  if (props.producto && props.producto.created_at) {
    formattedDate.value = formatDate(props.producto.created_at);
  }
});







const handleAddToCart = () => {
  addToCart(props.producto.id);
};


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
  background-color: #ffffff;
  
}

.contenedor>div {
  flex: 1 1 50%;
  box-sizing: border-box;
  padding: 10px;
}

/* left -------------------------------------------------------------------*/
/* .contenedor .left {
  background-color: aqua;
} */

.contenedor .left .image img {
  width: 100%;
  height: 450px;
  object-fit: cover;
  border-radius: 10px;
}


/* right ------------------------------------------------------------------*/

/* .contenedor .right * {
  margin-bottom: 5px;
} */

.contenedor .right {
  /* Color de fondo */

  /* Color claro para contraste */

  /* height: 100vh; */
  display: flex;
  flex-direction: column;

  /* overflow-y: scroll; */

  
}


.contenedor .right::-webkit-scrollbar {
  width: 12px;

}

.contenedor .right::-webkit-scrollbar-track {
  background: #f1f1f1;

  border-radius: 10px;

}

.contenedor .right::-webkit-scrollbar-thumb {
  background: #1E90FF;

  border-radius: 10px;

  border: 2px solid #f1f1f1;

}

.contenedor .right::-webkit-scrollbar-thumb:hover {
  background: #0b7dda;

}

.contenedor .right::-webkit-scrollbar-thumb:active {
  background: #065a9e;

}


/* .contenedor .right .principal {} */

.contenedor .right .principal .nombre {
  font-size: 40px;
  font-weight: bold;



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

  font-size: 20px;

}

.contenedor .right .principal .info_nombre>div span {

  color: #8f8f8f;

}

.contenedor .right .principal .info_nombre>div h1 {

  font-weight: bold;
}

.contenedor .right .precio  {
  display: flex;
align-items: center;
  gap: 10px;
}

.contenedor .right .precio h1{
  font-size: 65px;
  font-weight: bold;
  color: #0B86E7;
}

.contenedor .right .precio span {
  font-size: 30px;
  font-weight: lighter;
  text-decoration: line-through;
}


.descripcion .titulo {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 5px;

}

.descripcion .titulo h1 {
  font-size: 1.8rem;

  font-weight: 700;
}

.descripcion .titulo span{
  font-size: 1.2rem;
  font-weight: 400;
  color: #8f8f8f;
}

.descripcion .subtitulo{
  font-size: 30px;
  font-weight:lighter;
  margin-bottom: 5px;
  color: #505050;
}

.fecha{
  font-size: 20px;
  font-weight:bold;
  color: #969696;
  margin-bottom: 10px;
}

.fecha span {

  font-weight: lighter;

}

.descripcion_contenido {


  font-size: 20px;
  line-height: 1.5;
  color: #333;
  max-width: 100%;
  word-wrap: break-word;
  overflow-wrap: break-word;
  margin-bottom: 10px;

}
.datos_extra {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
  width: 50%;
  gap: 16px;
  margin: 20px 0;
}

.datos_extra div{
  font-size: 22px;
  /* Espacio entre los elementos */
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
  border-radius: 400px;
  font-size: 20px;
  cursor: pointer;
    height: 55px;
}

.buttons>div {
  display: flex;
  gap: 10px;
  /* Ajusta el valor según el espacio que quieras entre los botones horizontales */
}
.buttons button:hover{
  transform: scale(1.05);
  font-weight: bold;
}

.buttons button:active {
  transform: scale(0.9);
  font-weight: bold;
}


.buttons>div button {
  flex: 1;
  /* Hace que los botones dentro del div ocupen igual espacio */
  padding: 10px;
  border: none;
  border-radius: 400px;
  font-size: 20px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  height: 55px;
}

.buttons>div button i {
  margin-right: 5px;
  /* Espacio entre el icono y el texto */
}

.buttons>div button:first-child {
  background: rgb(154, 231, 11);
    background: linear-gradient(45deg, rgba(154, 231, 11, 1) 0%, rgba(11, 231, 44, 1) 72%);
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

  .right *{
    text-align: center;
    margin: auto;
  }
}


</style>
