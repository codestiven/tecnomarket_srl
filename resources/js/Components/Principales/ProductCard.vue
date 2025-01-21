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
    <div class="up">
      <div class="up_image">
        <div>
          <div class="oferta" v-show="product.es_oferta">
            <i class="fa-solid fa-percent"></i>
            <span>Oferta</span>
          </div>


          <div v-show="isNew" class="New">
            <i class="fa-solid fa-check"></i>
            <span>Nuevo</span>
          </div>


        </div>
        <button @click="handleLikeProduct" class="gusta">
          {{ likesCount }}
          <i :class="isSaved ? 'fa-solid fa-heart' : 'fa-regular fa-heart'"></i>
        </button>
      </div>
      <div class="image">
        <a :href="`/Productos/${product.nombre}`">
          <img :src="product.image" alt="Product Image" class="imageUrl" loading="lazy" />
        </a>
      </div>
    </div>

    <div class="center">
      <div class="name">
        <div class="nombre">

          <p>
            <a :href="`/Productos/${product.nombre}`">{{ product.nombre }}</a>
        </p>
        </div>
        <!-- <span>( {{ product.stock }} )</span> -->
      </div>
      <div class="marcation">
        <span>{{ product.marca.nombre }} - {{ product.categoria.nombre }}</span>
      </div>
      <div class="price" v-if="!product.es_oferta">
        <p>RD$ {{ Number(product.precio).toLocaleString() }}</p>
      </div>

      <div class="price" v-else>
        <p>RD$ {{ Number(product.oferta.precio_oferta).toLocaleString() }}</p>
        <span>RD$ {{ Number(product.precio).toLocaleString() }}</span>
      </div>

    </div>
    <div class="down">

      <button v-if="!isInCart" class="agregar" @click="handleAddToCart">
        <i class="fa-solid fa-cart-shopping"></i> Agregar a carrito
      </button>
      <button v-else class="agregado" @click="handleAddToCart">
        <i class="fa-solid fa-check"></i> Agregado
      </button>
      <button class="comprar" @click="handlePurchase">
        <i class="fa-solid fa-basket-shopping"></i> comprar
      </button>

    </div>
  </div>







</template>



<style scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.card {

  height: 400px;
  background-color: #F9F9F9;
  padding: 10px;
  border-radius: 15px;
  overflow: hidden;

  display: grid;
  grid-template-rows: repeat(12, 1fr);

  /* gap: 10px;  */

}

.card>div {
  overflow: hidden;
}

/* up ---------------------------------------------------------------------------------------- */

.card .up {
  grid-row: span 6;

  /* background-color: rgb(34, 3, 3); */
  position: relative;

}

.card .up .up_image {
  width: 100%;
  height: 60px;

  align-items: center;
  /* background-color: #0b88e762; */
  position: absolute;
  z-index: 4;

  display: flex;
  justify-content: space-between;

  padding: 10px 10px 10px 0px;

}

.card .up .up_image>div {
  width: 100%;
  height: auto;
  display: flex;
  flex-direction: column;
  /* align-items: center; */
  justify-content: center;

  gap: 5px;
  /* background-color: #0b63e7; */
  transform: translate(0, 17px);


}

.card .up .up_image .gusta {
  font-size: 20px;
  font-weight: bold;
  color: rgb(20, 20, 20);
  transition: color 0.3s;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 7px;
  transition: 250ms;

}

.card .up .up_image .gusta:hover {
  color: rgb(30, 116, 214);
  transform: scale(1.3);
}

.card .up .up_image .gusta:active {
  color: rgb(30, 116, 214);
  transform: scale(1);
}


.card .up .up_image .gusta i {
  font-size: 28px;

}

.card .up .up_image .oferta,
.card .up .up_image .New {
  width: 50%;
  font-size: 0.9rem;
  color: white;
  padding: 6px 12px;
  border-radius: 0;
  display: flex;
  align-items: center;
  gap: 12px;
  justify-content: center;
  clip-path: polygon(0% 0%, 100% 0%, 93% 50%, 100% 100%, 0% 100%);

  border-radius:2px ;

}

.card .up .up_image .oferta {
  background-color: #F36262;
}

.card .up .up_image .New {
  background-color: #0f7bd4;
}

.card .up .up_image .oferta i,
.card .up .up_image .New i {
  font-size: 1.1rem;
  /* Tamaño de ícono ajustado */
}

/* Media Queries para Responsividad */
@media (max-width: 768px) {

  .card .up .up_image .oferta,
  .card .up .up_image .New {
    font-size: 0.85rem;
    /* Reducir ligeramente el tamaño en pantallas medianas */
    gap: 10px;
    padding: 5px 10px;
    width: 55%;
    /* Ancho ajustado en pantallas medianas */
  }

  .card .up .up_image .oferta i,
  .card .up .up_image .New i {
    font-size: 1rem;
    /* Tamaño de ícono ajustado en pantallas medianas */
  }
}

@media (max-width: 480px) {

  .card .up .up_image .oferta,
  .card .up .up_image .New {
    font-size: 0.8rem;
    /* Fuente reducida en pantallas pequeñas */
    gap: 8px;
    padding: 4px 8px;
    width: 60%;
    /* Ancho ajustado en pantallas pequeñas */
  }

  .card .up .up_image .oferta i,
  .card .up .up_image .New i {
    font-size: 0.9rem;
    /* Ícono reducido en pantallas pequeñas */
  }
}

.card .up .up_image .oferta i {
  font-size: 25px;

}





.card .up .image {
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;



}

.card .up .image img {


  object-fit: cover;
  cursor: pointer;
  border-radius: 8px;
  height: 180px;


}

/* center ---------------------------------------------------------------------------------------- */

.card .center {
  grid-row: span 4;
  /* background-color: lightblue; */
  display: flex;
  flex-direction: column;
  /* justify-content: center; */
  padding: 5px;
}

/* name -------------------------- */

.card .center .name {
  display: flex;
  gap: 3%;
  align-items: center;
}

.card .center .name .nombre {
  max-width: 100%;
  display: block;
  /* Permite ajuste en varias líneas */
}

.card .center .name .nombre p {
  font-size: 22px;
  font-weight: bold;
  color: #3D3D3D;
  margin: 0;
  line-height: 1.2;
  /* Ajusta el espacio entre líneas */
  max-width: 100%;
  max-height: 2.4em;
  /* Altura máxima para 2 líneas */
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 2;
  /* Limita a un máximo de 2 líneas (para navegadores con prefijo webkit) */
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: normal;

  /* Propiedad estándar sin prefijo */
  display: box;
  box-orient: vertical;
  line-clamp: 2;
  /* Limita a un máximo de 2 líneas (para navegadores modernos) */
}

.card .center .name .nombre p a {
  text-decoration: none;
  color: inherit;
  display: inline;
}


.card .center .name .nombre p:hover {
  font-weight: bold;
  color: #295f92;



}

.card .center .name span {
  font-size: 16px;
  font-weight: bold;
  color: #8d8d8dd5;
}

/*marcation -------------------------- */

.marcation {
  text-align: start;
  font-size: 14px;
  font-weight: bold;
  color: #8D8D8D;

}

/*precio -------------------------- */

.price {
  display: flex;
  align-items: end;
  gap: 2%;



}

.price p {
  font-size: 25px;
  font-weight: bold;
  white-space: nowrap;
  color: #393939;

}

.price span {
  font-size: 15px;
  font-weight: 600;
  text-decoration: line-through;
  color: #7D7D7D;


}


/* down ---------------------------------------------------------------------------------------- */



.card .down {
  grid-row: span 2;
  /* Ocupa 2 columnas */
  /* background-color: lightgreen; */
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 5%;
}

.card .down button {
  /* background-color: red; */
  border-radius: 13px;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: left;
  gap: 5%;
  padding: 10px;

  width: 130px;
  height: 50px;

  font-weight: bold;

  font-size: 17px;
}

.card .down button:hover {

  transform: scale(1.2);


}

.card .down button:active {
  background-color: #0be7b7;
  color: #fff;
  transform: scale(1);
}

.card .down button:active .fa-solid {
  color: #ECECEC;

}

.card .down button .fa-solid {
  font-size: 20px;

}

.agregar {
  color: #7B7B7B;
  background-color: #ECECEC;

}

.agregar .fa-solid {
  color: #7B7B7B;
}

.agregado {
  color: #ffffff;
  background-color: #fc6262;

}

.agregado button:active {
  color: #ffffff;
  background-color: #8a3333;

}

.agregdo .fa-solid {
  color: #ffffff;
}

.agregar:hover {

  background-color: #d3d3d3;
}




.comprar {
  color: white;
  background-color: #0B86E7;

}

.comprar:hover {

  background-color: #0b63e7;
}
</style>