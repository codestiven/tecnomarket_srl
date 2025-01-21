<template>

  <Head :title="producto.nombre" />
  <Header />

  <!-- Contenedor principal -->
  <div class="container mx-auto p-6 grid grid-cols-1 lg:grid-cols-2 gap-8">

    <!-- Imagen del producto (más grande aún) -->
    <div class="lg:col-span-1 flex justify-center">
      <div class="rounded-lg overflow-hidden max-w-3xl"> <!-- Imagen más grande con max-w-3xl -->
        <img :src="producto.image" :alt="producto.nombre" class="w-full h-auto object-cover rounded-lg shadow-md"
          loading="lazy" />
      </div>
    </div>

    <!-- Datos principales del producto (Columna derecha con fondo blanco) -->
    <div class="lg:col-span-1 bg-white p-6 rounded-lg shadow-lg space-y-6">
      <!-- Nombre del producto -->
      <h1 class="text-4xl font-bold text-gray-900">{{ producto.nombre }}</h1>

      <!-- Marca y código (disposición horizontal) -->
      <div class="flex space-x-8">
        <div class="text-gray-700">
          <h5 class="font-medium">Código:</h5>
          <span class="font-bold text-lg">{{ producto.id }}</span> <!-- Código resaltado -->
        </div>
        <div class="text-gray-700">
          <h5 class="font-medium text-blue-700">Marca:</h5> <!-- Marca en color azul -->
          <span class="text-lg font-semibold">{{ producto.marca ? producto.marca.nombre : 'Desconocida' }}</span>
          <!-- Marca destacada -->
        </div>
      </div>

      <!-- Precio destacado -->
      <div class="text-3xl font-bold text-red-600 relative">
        <!-- Etiqueta de oferta -->
        <div v-if="producto.es_oferta"
          class="absolute top-0 left-0 bg-yellow-400 text-white text-xs font-semibold py-1 px-2 rounded-tr-lg rounded-bl-lg">
          ¡Oferta!
        </div>

        <!-- Precio normal (cuando no está en oferta) -->
        <span v-if="!producto.es_oferta">RD$ {{ producto.precio ? Number(producto.precio).toLocaleString() :
          'Desconocido' }}</span>

        <!-- Precio en oferta -->
        <div v-else class="bg-yellow-100 p-4 rounded-lg shadow-md">
          <h4 class="text-4xl font-extrabold text-green-600">
            RD$ {{ producto.oferta && producto.oferta.precio_oferta ?
              Number(producto.oferta.precio_oferta).toLocaleString() : 'Desconocido' }}
          </h4>
          <span class="line-through text-gray-500 text-xl">
            RD$ {{ producto.precio ? Number(producto.precio).toLocaleString() : 'Desconocido' }}
          </span>
        </div>
      </div>


      <!-- Descripción -->
      <div class="space-y-4">
        <h2 class="text-lg font-semibold">Descripción</h2>
        <p>{{ producto.descripcion ? producto.descripcion : 'No disponible' }}</p>
        <p class="text-sm text-gray-600">Categoría: {{ producto.categoria ? producto.categoria.nombre : 'Desconocida' }}
        </p>
      </div>

      <!-- Características técnicas -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div v-if="detallesProducto && detallesProducto.color" class="text-gray-700">
          <i class="fa-solid fa-palette"></i> Color: {{ detallesProducto.color }}
        </div>
        <div v-if="detallesProducto && detallesProducto.peso" class="text-gray-700">
          <i class="fa-solid fa-weight-hanging"></i> Peso: {{ detallesProducto.peso }} kg
        </div>
        <div v-if="detallesProducto && detallesProducto.procesador" class="text-gray-700">
          <i class="fa-solid fa-microchip"></i> Procesador: {{ detallesProducto.procesador }}
        </div>
        <div v-if="detallesProducto && detallesProducto.ram" class="text-gray-700">
          <i class="fa-solid fa-memory"></i> RAM: {{ detallesProducto.ram }} GB
        </div>
        <div v-if="detallesProducto && detallesProducto.almacenamiento" class="text-gray-700">
          <i class="fa-solid fa-hard-drive"></i> Almacenamiento: {{ detallesProducto.almacenamiento }} GB
        </div>
      </div>

      <!-- Métodos de envío y pago -->
      <div class="bg-gray-50 p-4 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold mb-4">Información de entrega</h3>
        <div class="flex space-x-4 items-center">
          <div class="text-center">
            <i class="fa-solid fa-truck fa-2x text-gray-700"></i>
            <p>Envío gratis</p>
          </div>
          <div class="text-center">
            <i class="fa-solid fa-bolt fa-2x text-gray-700"></i>
            <p>Entrega rápida</p>
          </div>
          <div class="text-center">
            <i class="fa-solid fa-store fa-2x text-gray-700"></i>
            <p>Recoge en tienda</p>
          </div>
        </div>
        <h3 class="text-lg font-semibold mt-6 mb-4">Métodos de pago</h3>
        <ul class="space-y-2">
          <li><i class="fa-solid fa-credit-card"></i> Tarjeta de crédito</li>
          <li><i class="fa-solid fa-money-bill"></i> Transferencia bancaria</li>
          <li><i class="fa-solid fa-mobile-alt"></i> Compra en la app</li>
        </ul>
      </div>

      <!-- Garantía y financiamiento -->
      <div class="bg-gray-50 p-4 rounded-lg shadow-md mt-6">
        <h3 class="text-lg font-semibold">Garantía y financiamiento</h3>
        <p>Garantía de 1 año en todos los productos</p>
        <a :href="`/solicitud-financiamiento/${producto.id}`" class="text-blue-500 hover:underline">Solicitar
          financiamiento</a>
      </div>

      <!-- Botones de acción reorganizados -->
      <div class="flex flex-col space-y-4 mt-6">
        <!-- Primera fila de botones con dos botones -->
        <div class="flex space-x-4">
          <button class="bg-green-600 text-white py-3 px-6 w-full rounded-lg hover:bg-green-700"
            @click="whatsappAction">
            <i class="fa-brands fa-whatsapp"></i> WhatsApp
          </button>
          <button class="bg-blue-500 text-white py-3 px-6 w-full rounded-lg hover:bg-blue-600" @click="handleAddToCart">
            {{ isInCart ? 'Añadido' : 'Añadir a carrito' }}
          </button>
        </div>
        <!-- Segunda fila con botón más grande -->
        <div class="flex">
          <button class="bg-yellow-500 text-white py-3 px-6 w-full rounded-lg hover:bg-yellow-600 text-lg">
            Comprar ahora
          </button>
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
  object-fit: contain;
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

.contenedor .right .principal .info_nombre>div h4 {

  font-weight: bold;
}

.contenedor .right .precio  {
  display: flex;
align-items: center;
  gap: 10px;
}

.contenedor .right .precio h4{
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

.descripcion .titulo h2 {
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