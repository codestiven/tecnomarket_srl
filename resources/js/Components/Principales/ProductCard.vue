<script setup>
import { Link } from "@inertiajs/vue3";
import { defineProps, defineEmits } from "vue";

const props = defineProps({
  product: {
    type: Object,
    default: () => ({
      id: 2,
      nombre: "MacBook Pro 16",
      descripcion: "Laptop de alto rendimiento para profesionales.",
      precio: "2500.00",
      categoria_id: 1,
      marca_id: 1,
      oferta_id: null,
      image: "https://ssl-product-images.www8-hp.com/digmedialib/prodimg/lowres/c08523987.png",
      created_at: null,
      updated_at: null,
    }),
  },
});

const emits = defineEmits(["addToCart", "likeProduct"]);

const handleAddToCart = () => {
  emits("addToCart", product);
};

const handleLikeProduct = () => {
  emits("likeProduct", product);
};
</script>

<template>
  <div class="cartas">
    <div class="imagen">
      <div class="me_gusta">
        <button @click="handleLikeProduct">
          <svg
            class="w-5 h-5"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 512 512"
            fill="red"
          >
            <path
              d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"
            />
          </svg>
        </button>
      </div>
      <Link :href="`/Productos/${product.id}`">
        <img :src="product.image" alt="Product Image" class="imageUrl" />
      </Link>
    </div>

    <div class="contenido">
      <h1 class="nombre">
        <Link :href="`/Productos/${product.id}`">{{ product.nombre }}</Link>
      </h1>
      <div class="precio">
        <h3>RD$ {{ Number(product.precio).toLocaleString() }}</h3>
      </div>
    </div>

    <div class="boton">
      <button @click="handleAddToCart">
        Agregar al carrito
        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
          <path
            d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"
          />
        </svg>
      </button>
    </div>
  </div>
</template>


<style scoped>
.cartas {
  background-color: #fff;
  padding: 10px;
  overflow: hidden;
  border-radius: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
  display: flex;
  flex-direction: column;
  height: 100%;
}

.cartas:hover {
  transform: scale(1.05);
}

.imagen {
  position: relative;
  flex: 2;
  overflow: hidden;
}
.imagen:hover .imageUrl{
  transform: scale(1.3) !important;
  opacity: 1 !important;
}
.me_gusta {
  position: absolute;
  top: 0;
  right: 0;
  width: 100%;
  display: flex;
  justify-content: flex-end;
  padding: 10px;
  z-index: 5;
}

.imagen img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 20px;
}

.contenido {
  padding: 10px;
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.contenido h1 {
  margin-top: 10px;
  text-align: center;
  font-size: 17px; /* Texto adaptativo */
  font-weight: 700;
  overflow: hidden;
  text-overflow: ellipsis;
  /* white-space: nowrap; */
}

.contenido h1:hover{
  color: var(--primary-color);
  list-style: inside;
}

.precio {
  display: flex;
  justify-content: center;
}

.precio h3 {
  display: flex;
  justify-content: center;
  font-size: 2.5vw; /* Texto adaptativo */
  font-weight: bold;
  text-align: center;
  color: rgb(36, 36, 36);
  font-family: 'Helvetica Bold';
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.boton {
  margin-top: 10px;
  display: flex;
  justify-content: center;
  flex: 0;
}

.boton button {
  display: flex;
  align-items: center;
  gap: 5px;
  padding: 10px 20px;
  background-color: var(--complementario-color);
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transform: translate(0, 100px);
}

.boton button:hover {
  background-color: var(--primary-color);
  box-shadow: 0px 0px 30px 10px  rgba(41, 141, 255, 0.75);
  transform: scale(1.1);
}

.cartas:hover .boton button {

    transform: translate(0, 0);
}

.boton button svg {
  fill: rgb(255, 255, 255);
  transform: scale(0.9);
}

@media (max-width: 1024px) {
  .cartas .boton button {

    transform: translate(0, 0);
}

}


</style>