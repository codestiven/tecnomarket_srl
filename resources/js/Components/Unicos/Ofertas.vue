<template>
  <div class="container">
    <div class="titulo">
      <h1>Encuentra tu producto ideal</h1>
      <h2>Explora las mejores ofertas en laptops y accesorios de tecnología.</h2>
    </div>
    <div class="swiper-container">
      <!-- Custom Previous Button -->
      <button class="prev-button" @click="slidePrev">
        <i class="fas fa-chevron-left"></i>
      </button>

      <!-- Swiper Component -->
      <swiper ref="swiper" :pagination="true" :slides-per-view="1" :space-between="0" :loop="true" :autoplay="autoplay"
        :modules="modules" :breakpoints="breakpoints" class="mySwiper" @swiper="onSwiper">
        <swiper-slide v-for="(product, index) in products" :key="index">
          <ProductCard :product="product" />
        </swiper-slide>
      </swiper>

      <!-- Custom Next Button -->
      <button class="next-button" @click="slideNext">
        <i class="fas fa-chevron-right"></i>
      </button>
    </div>
    <div class="ver-mas">
      <button @click="irAPasantias">
        <a href="/Productos">Ver todos los productos</a>
      </button>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/autoplay';
import 'swiper/css/pagination';
import { Navigation, Autoplay, Pagination } from 'swiper/modules';
import ProductCard from "@/Components/Principales/ProductCard.vue";

export default {
  components: {
    Swiper,
    SwiperSlide,
    ProductCard,
  },
  setup() {
    const swiperInstance = ref(null);
    const products = ref([]);

    const onSwiper = (swiper) => {
      swiperInstance.value = swiper;
    };

    const slideNext = () => {
      if (swiperInstance.value) {
        swiperInstance.value.slideNext();
      }
    };

    const slidePrev = () => {
      if (swiperInstance.value) {
        swiperInstance.value.slidePrev();
      }
    };

    // Fetch data from API on component mount
    onMounted(async () => {
      try {
        const response = await axios.get('/api/productos/ofertas');
        products.value = response.data.map(product => ({
          id: product.id,
          nombre: product.nombre,
          descripcion: product.descripcion,
          precio: product.precio,
          categoria: {
            id: product.categoria.id,
            nombre: product.categoria.nombre,
            created_at: product.categoria.created_at,
            updated_at: product.categoria.updated_at,
          },
          marca: {
            id: product.marca.id,
            nombre: product.marca.nombre,
            created_at: product.marca.created_at,
            updated_at: product.marca.updated_at,
          },
          image: product.image,
          oferta: product.oferta ? {
            id: product.oferta.id,
            producto_id: product.oferta.producto_id,
            precio_oferta: product.oferta.precio_oferta,
            created_at: product.oferta.created_at,
            updated_at: product.oferta.updated_at,
          } : null,
          detalles_producto: product.detalles_producto,
          stock: product.stock,
          es_oferta: product.es_oferta
        }));
      } catch (error) {
        console.error('Error fetching products data:', error);
      }
    });

    const breakpoints = {
      640: {
        slidesPerView: 1,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 30,
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 40,
      },
    };

    return {
      slideNext,
      slidePrev,
      onSwiper,
      products,
      modules: [Navigation, Autoplay, Pagination],
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      breakpoints,
    };
  },
};
</script>





<style scoped>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');

.container {
  width: 100%;
  margin: 100px auto;
background: rgb(106, 180, 227);
  background: linear-gradient(132deg, rgba(106, 180, 227, 1) 20%, rgba(81, 122, 167, 1) 100%);
  padding: 20px;
}

.swiper-container {
  position: relative;
  width: 100%;
  height: 300px;
  display: flex;
  align-items: center;
}

.mySwiper {
  width: 100%;
  height: 300px;
  flex-grow: 1;
}

.swiper-slide {
  display: flex;
  align-items: center;
  justify-content: center;
}



.prev-button,
.next-button {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background-color: rgba(0, 0, 0, 0.5);
  color: #fff;
  border: none;
  padding: 10px;
  cursor: pointer;
  z-index: 10;
  font-size: 18px;
  border-radius: 50%;
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.prev-button {
  left: 10px;
}

.next-button {
  right: 10px;
}

.prev-button:hover,
.next-button:hover {
  background-color: rgba(0, 0, 0, 0.7);
}

@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');

.swiper-container {
  position: relative;
  width: 100%;
  height: auto;
  display: flex;
  align-items: center;
  margin-top: 50px;
}

.mySwiper {
  width: 100%;
  height: 100%;
}

.swiper-slide {
  display: flex;
  justify-content: center;
  align-items: center;
}

.slide-content {
  padding: 1rem;
  text-align: left;
  background-color: white;
  border-radius: 10px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 230px;
  width: 100%;
  margin-right: 20px;
}

.slide-content:last-child {
  margin-right: 0;
}

.slide-content .header {
  display: flex;
  align-items: center;
  margin-bottom: 1rem;
}



.slide-content .title {
  font-size: 1.25rem;
  font-weight: bold;
  color: #1d1d1d;
}

.slide-content .company {
  font-size: 1rem;
  color: #777;
  margin-bottom: 0.5rem;
}

.slide-content .content {
  font-size: 1rem;
  color: #333;
  margin-bottom: 0.5rem;
}

.slide-content .location {
  font-size: 0.875rem;
  color: #777;
}


.prev-button,
.next-button {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background-color: rgba(0, 0, 0, 0.5);
  color: #fff;
  border: none;
  padding: 10px;
  cursor: pointer;
  z-index: 10;
  font-size: 18px;
  border-radius: 50%;
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.prev-button {
  left: 10px;
}

.next-button {
  right: 10px;
}

.prev-button:hover,
.next-button:hover {
  background-color: rgba(0, 0, 0, 0.7);
}

.cantidad_vacantes {
  margin-top: 50px;
  background-color: #f0f0f0;
  display: flex;
  flex-direction: column;
  padding: 50px 60px;
}

.titulo {
  text-align: center;
}

.titulo h1 {
  color: #ffffff;
  font-weight: bold;
  font-size: 40px;
}

.titulo h2 {
  color: #1d1d1d;
  font-weight: bold;
  font-size: 25px;
}

.carousel-container {
  margin: 0 auto;
  max-width: 90%;
  position: relative;
  margin-top: 40px;
}

.vacancies-swiper {
  width: 100%;
}

.ver-mas {
  display: flex;
  justify-content: center;
  margin-top: 40px;
  margin-bottom: 60px;
}

.ver-mas button {
  padding: 10px 20px;
  font-size: 16px;
  color: #fff;
  background-color: #f87d7d;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.ver-mas button:hover {
  background-color: #9e3c3c;
}

.ver-mas button a {
  color: #fff;
  text-decoration: none;
}
</style>
