<script setup>
import { Link } from "@inertiajs/vue3";
import { defineProps } from "vue";
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import { differenceInDays, parseISO } from 'date-fns'; // Importa date-fns para calcular la diferencia en días

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

    // Verifica si el producto actual está en la lista de productos guardados
    isSaved.value = savedProducts.some(savedProduct => savedProduct.producto_id === productoId);
  } catch (error) {
    console.error("Error checking if product is saved:", error);
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

onMounted(() => {
  const productoId = props.product.id;
  fetchLikesCount(productoId);
  checkIfProductIsSaved(productoId); // Llama a la función para verificar si el producto está guardado

  if (props.product.created_at) {
    calculateIsNew(props.product.created_at); // Llama a la función para calcular si el producto es nuevo
  }

  console.log(isNew.value);
});
</script>



<template>


  <div class="card">
    <div class="up">
      <div class="up_image">
        <div>
          <div class="oferta" v-show="product.oferta">
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
        <Link :href="`/Productos/${product.id}`">
        <img :src="product.image" alt="Product Image" class="imageUrl" />
        </Link>
      </div>
    </div>

    <div class="center">
      <div class="name">
        <div class="nombre">

          <h1>
            <Link :href="`/Productos/${product.id}`">{{ product.nombre }}</Link>
          </h1>
        </div> <span>( {{ product.stock }} )</span>
      </div>
      <div class="marcation">
        <span>{{ product.marca.nombre }} - {{ product.categoria.nombre }}</span>
      </div>
      <div class="price">
        <h1>RD$ {{ Number(product.precio).toLocaleString() }}</h1> <span>RD$ 50,000.00</span>
      </div>
    </div>
    <div class="down">

      <button class="agregar"> <i class="fa-solid fa-cart-shopping"></i> Agregar a carrito</button>
      <button class="comprar"> <i class="fa-solid fa-basket-shopping"></i> comprar</button>
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
  z-index: 1000;

  display: flex;
  justify-content: space-between;

  padding: 10px;

}

.card .up .up_image > div {
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


.card .up .up_image .gusta i{
  font-size: 28px;

}

.card .up .up_image .oferta {
  width: 60%;
  font-size: 20px;
  font-weight: bold;
  color: white;
  background-color: #F36262;
  padding: 5px 10px;
  border-radius: 5px;

  display: flex;
  align-items: center;
  gap: 20px;

}

.card .up .up_image .New {
    width: 60%;
      font-size: 20px;

      color: white;
      background-color: #0f7bd4;
      padding: 5px 10px;
      border-radius: 5px;
    
      display: flex;
      align-items: center;
      gap: 20px;
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

  width: 360px;
  object-fit: cover;
  cursor: pointer;
  border-radius: 8px;


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
  /* height:30px ; */
  display: flex;

  /* background-color: aqua; */
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;


}

.card .center .name .nombre h1 {
  font-size: 22px;
  font-weight: bold;
  color: #3D3D3D;


}

.card .center .name .nombre h1:hover {
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

.price h1 {
  font-size: 27px;
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


.agregar:hover {

  background-color: #d3d3d3;
}
.agregar .fa-solid {
  color: #7B7B7B;
}



.comprar {
  color: white;
  background-color: #0B86E7;

}

.comprar:hover {

  background-color: #0b63e7;
}
</style>