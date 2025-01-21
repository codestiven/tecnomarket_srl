<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import { differenceInDays, parseISO } from 'date-fns'; // Importa date-fns para calcular la diferencia en días
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
  product: {
    type: Object,
    default: () => ({
      id: 16,
      nombre: "MacBook Pro 16",
      descripcion: "Laptop de alto rendimiento para profesionales.",
      precio: "2500.00",
      categoria_id: 1,
      marca_id: 1,
      oferta_id: null,
      image: "https://ssl-product-images.www8-hp.com/digmedialib/prodimg/lowres/c08523987.png",
      stock: 77,
      es_oferta: false,  // Valor por defecto agregado
      created_at: null,
      updated_at: null,
      categoria: {
        id: 1,
        nombre: "Laptops",
        created_at: null,
        updated_at: null
      },
      marca: {
        id: 1,
        nombre: "Apple",
        created_at: "2024-08-14T16:00:40.000000Z",
        updated_at: "2024-08-14T16:00:40.000000Z"
      },
      oferta: {} // Aquí puedes definir la estructura esperada si hay datos relevantes para las ofertas.
    }),
  },
});

const isSaved = ref(false); // Variable para almacenar si el producto ya está guardado
const likesCount = ref(0); // Variable para almacenar la cantidad de "me gustas"
const isNew = ref(false); // Variable para indicar si el producto es nuevo
const isInCart = ref(false); // Variable para indicar si el producto está en el carrito

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

// Función para actualizar el estado de isInCart
const updateCartStatus = (productoId) => {
  const cart = JSON.parse(localStorage.getItem('cart')) || [];
  isInCart.value = cart.includes(productoId);
};

// Función para calcular si el producto es nuevo
const calculateIsNew = (createdAt) => {
  const now = new Date();
  const creationDate = parseISO(createdAt);
  const daysDifference = differenceInDays(now, creationDate);

  // Si el producto tiene menos de 14 días de creado, es nuevo
  isNew.value = daysDifference <= 14;
};

const fetchLikesCount = async (productoId) => {
  try {
    const response = await axios.get(`/guardados/likes/${productoId}`);
    likesCount.value = response.data.likes_count;
  } catch (error) {
    console.error("Error fetching likes count:", error);
  }
};

const checkIfProductIsSaved = async (productoId) => {
  try {
    const response = await axios.get('/guardadosjson');
    const savedProducts = response.data;

    isSaved.value = savedProducts.some(savedProduct => savedProduct.producto_id === productoId);
  } catch (error) {
    // Loguear el error solo una vez en modo desarrollo
    // if (process.env.NODE_ENV === 'development') {
    //   console.error("Error checking if product is saved:", error);
    // }

    // Mostrar un mensaje de error si es necesario o manejarlo de otra manera
  }
};

const handleLikeProduct = () => {
  const productoId = props.product.id;

  axios.post('/guardados', {
    producto_id: productoId
  })
    .then(response => {
      if (response.status === 400) {
        return axios.delete(`/guardados/${productoId}`);
      }

      likesCount.value++;

      Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: 'Producto guardado correctamente'
      });

      isSaved.value = true; // Marca el producto como guardado
    })
    .catch(error => {
      if (error.response && error.response.status === 400) {
        return axios.delete(`/guardados/${productoId}`)
          .then(() => {
            Swal.fire({
              icon: 'success',
              title: 'Éxito',
              text: 'Producto eliminado de guardados'
            });
            likesCount.value--;
            isSaved.value = false; // Marca el producto como no guardado
          })
          .catch(deleteError => Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error al eliminar el producto: ' + (deleteError.response?.data.message || 'Error inesperado')
          }));
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'El usuario no está autenticado'
        });
      }
    });
};

const handleAddToCart = () => {
  addToCart(props.product.id);
};

const handlePurchase = () => {
  localStorage.removeItem('pendingOrder');
  Swal.fire({
    html: `
  <div id="comprarBackground" class="comprar-fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="comprar-popup-container relative bg-white rounded-lg shadow-lg w-full max-w-xl h-96 flex flex-col items-center justify-center p-4">
      <h2 class="comprar-popup-title absolute text-3xl font-bold text-white text-center">¿Cómo deseas realizar la compra?</h2>
      <div class="comprar-options-container w-full h-full flex overflow-hidden">
        <div id="whatsappOption" class="comprar-popup-option comprar-whatsapp-option flex-1 flex flex-col items-center justify-center cursor-pointer transition-colors duration-300 bg-white rounded-lg m-2">
          <i class="fa-brands fa-whatsapp text-6xl comprar-icon comprar-whatsapp-icon transition duration-300"></i>
          <span class="text-2xl mt-4 font-bold comprar-whatsapp-text transition duration-300">WhatsApp</span>
        </div>
        <div id="accountOption" class="comprar-popup-option comprar-account-option flex-1 flex flex-col items-center justify-center cursor-pointer transition-colors duration-300 bg-white rounded-lg m-2">
          <i class="fa-solid fa-user text-6xl comprar-icon comprar-account-icon transition duration-300"></i>
          <span class="text-2xl mt-4 font-bold comprar-account-text transition duration-300">Usar Cuenta</span>
        </div>
      </div>
      <div>
<a href="/solicitud-financiamiento/${props.product.id}" class="inline-block bg-blue-300 text-white font-semibold py-2 px-4 rounded shadow hover:bg-blue-700 transition duration-300">
    Solicitar financiamiento de este producto
</a>


      </div>
    </div>
  </div>
    `,
    showConfirmButton: false,
    width: '100%',
    padding: '0',
    background: 'transparent',
    customClass: {
      popup: 'my-custom-popup-class'
    },
    didOpen: () => {
      const background = document.getElementById('comprarBackground');
      background.addEventListener('click', (event) => {
        if (event.target === background) {
          Swal.close(); // Cierra el popup
        }
      });

      document.getElementById('whatsappOption').addEventListener('click', whatsappAction);
      document.getElementById('accountOption').addEventListener('click', accountAction);
    }
  });
};

const whatsappAction = () => {
  // Obtén los detalles del producto
  const productName = props.product.nombre;
  const productCategory = props.product.categoria.nombre;
  const productPrice = props.product.precio;

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
      producto_id: props.product.id
    });


    Swal.fire({
      icon: 'success',
      title: 'Éxito',
      html: 'El producto comprado es <strong>' + props.product.nombre + '</strong>',
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
        producto_id: props.product.id
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

// Llamar a la función para comprobar si hay un pedido pendiente después del registro
const processPendingOrder = async () => {
  const pendingOrder = localStorage.getItem('pendingOrder');
  if (pendingOrder) {
    try {
      const orderData = JSON.parse(pendingOrder);
      const response = await axios.post('/pedidos', orderData);
      // Mostrar mensaje de éxito
      Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: 'Tu pedido ha sido creado después de registrarte.',
      });

      // Limpiar el estado guardado en localStorage
      localStorage.removeItem('pendingOrder');

    } catch (error) {
      Swal.fire({
        icon: 'success',
        title: 'Éxito',
        footer: 'Nos pondremos en contacto con contigo pronto.'
      });

      localStorage.removeItem('pendingOrder');
    }
  }
};

// Llamar a la función para procesar el pedido pendiente al cargar la página
processPendingOrder();
onMounted(() => {
  const productoId = props.product.id;
  fetchLikesCount(productoId);
  checkIfProductIsSaved(productoId); // Llama a la función para verificar si el producto está guardado

  if (props.product.created_at) {
    calculateIsNew(props.product.created_at); // Llama a la función para calcular si el producto es nuevo
  }

  // Inicializar el estado de isInCart
  updateCartStatus(productoId);
});
</script>




<template>
  <div class="card">
    <div class="grid-item image">
      <a :href="`/Productos/${product.nombre}`">
        <img :src="product.image" alt="Product Image" class="imageUrl" loading="lazy"  />
      </a>
    </div>
    <div class="grid-item datos">
      <div class="tipo">
        <span>{{ product.marca.nombre }} - {{ product.categoria.nombre }}</span>
        <span v-if="product.es_oferta" class="text-red-500 font-bold ml-2">Oferta</span>
      </div>

      <div class="nombre">
        <p>
          <a :href="`/Productos/${product.nombre}`">{{ product.nombre }}</a>
           <!-- <span>( {{ product.stock }} )</span> -->
        </p>
      </div>
      <div class="descripcion">
        <p> {{ product.descripcion }}
        </p>
      </div>
    </div>
    <div class="grid-item botones">
      <div class="like"> <button @click="handleLikeProduct" class="gusta">
          {{ likesCount }}
          <i :class="isSaved ? 'fa-solid fa-heart' : 'fa-regular fa-heart'"></i>
        </button></div>
      <div class="down">

        <button v-if="!isInCart" class="agregar" @click="handleAddToCart">
          <i class="fa-solid fa-cart-shopping"></i> Agregar
        </button>
        <button v-else class="agregado" @click="handleAddToCart">
          <i class="fa-solid fa-check"></i> Agregado
        </button>
      </div>
      <div class="precio">
        <p v-if="!product.es_oferta">RD$ {{ Number(product.precio).toLocaleString() }}</p>
        <p v-else>RD$ {{ Number(product.oferta.precio_oferta).toLocaleString() }}</p>
      </div>
      <div class="compra"> <button class="comprar" @click="handlePurchase"> <i class="fa-solid fa-basket-shopping"></i>
          comprar</button></div>

    </div>
  </div>
</template>

<style scoped>
.card {
  display: grid;
  background-color: #ffffff;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);

  grid-template-columns: repeat(12, 1fr);
  padding: 10px;
  width: 100%;
  height: 250px;
  gap: 10px;

  border-radius: 20px;

  overflow: hidden;

}

.grid-item {

  height: 100%;

}

/* imagen --------------------------------------------------------------------- */

.image {
  grid-column: span 2;


  display: flex;
  align-items: center;
  justify-content: center;
}

.image img {

  width: 100%;
  border-radius: 10px;
  object-fit: cover;
}

/* datos --------------------------------------------------------------------- */

.datos {
  grid-column: span 8;

  padding: 10px 0px;

  display: flex;
  flex-direction: column;
  align-items: right;
  /* justify-content: center; */
}

.datos .tipo {
  font-size: 23px;
  font-weight: lighter;
  color: #C0C0C0;

}

.datos .nombre {
  font-size: 2.2rem;
  /* Tamaño de fuente ajustado para la vista estándar */
  font-weight: bold;
  margin: 0;
  line-height: 1.3;
  /* Ajusta el espacio entre líneas */
  max-width: 100%;
  /* Asegura que el texto no se desborde del contenedor */
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 2;
  /* Limita a un máximo de 2 líneas */
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: normal;
  /* Permite que el texto se ajuste en múltiples líneas */
}

/* Media Queries para Responsividad */
@media (max-width: 768px) {
  .datos .nombre {
    font-size: 1.8rem;
    /* Reduce el tamaño de fuente en pantallas medianas */
  }
}

@media (max-width: 480px) {
  .datos .nombre {
    font-size: 1.5rem;
    /* Reduce aún más el tamaño de fuente en pantallas pequeñas */
  }
}

.datos .nombre span {
  font-size: 25px;
  color: #C0C0C0;
}

.datos .descripcion {
  font-size: 17px;
  width: 100%;
  height: 100px;
  overflow: hidden;
  /* Oculta el texto que se desborda */
  display: -webkit-box;

  /* Número de líneas visibles antes de mostrar puntos suspensivos */
  -webkit-box-orient: vertical;
  text-overflow: ellipsis;
  /* Muestra puntos suspensivos al final del texto si es necesario */
  line-height: 1.5;
  /* Ajusta el espacio entre líneas para controlar la altura de la línea */
}

/* botones ------------------------------------------------------------------------ */

.botones {
  grid-column: span 2;

  /* Color de fondo rojo */
  gap: 10px;
  display: flex;
  flex-direction: column;
  /* justify-content: space-between; */
  /* padding: 20px 0px; */
}

.botones .like {
  display: flex;
  justify-content: right;
  /* align-items: center; */
  font-size: 25px;
  padding: 5px;
}

.botones .down {
  display: flex;
  justify-content: center;
  align-items: center;

}

.botones .agregar {
  background-color: #e2504b;
  padding: 10px;
  border-radius: 100px;
  color: white;
  width: 70%;
  height: 40px;
}

.botones .agregado {
  background-color: #4b91e2;
  padding: 10px;
  border-radius: 100px;
  color: white;
  width: 70%;
  height: 40px;
}

.botones .agregar:hover {
  transform: scale(1.1);
}

.botones .precio {
  display: flex;
  justify-content: center;
  align-items: center;

  padding: 5px;


  font-size: 25px;
  font-weight: bold;
  color: rgb(51, 158, 247)
}



.compra {
  display: flex;
  justify-content: center;
  align-items: center;
}

.compra button {
  background-color: #4b80e2;
  padding: 10px;
  border-radius: 100px;
  color: white;
  font-size: 20px;
  font-weight: bold;
  width: 70%;
  transform:translate(0px, 100px);
}

.compra button:hover {
    background-color: #4171c9;
}

.compra button:active {
  background-color: #284375;
}

.card:hover .compra button{

    transform: translate(0px, 0px);
}
</style>
