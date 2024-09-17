<template>
    <div class="header-carousel-container">
        <!-- Swiper Component -->
        <swiper ref="swiper" :pagination="true" :slides-per-view="1" :loop="true" :autoplay="autoplay"
            :modules="modules" :breakpoints="breakpoints" class="mySwiper" @swiper="onSwiper">
            <swiper-slide v-for="(slide, index) in slides" :key="index">
                <div class="slide-content">
                    <img :src="slide.image" alt="Slide Image" class="slide-image" loading="lazy" >
                    <div class="slide-text">
                        <h2 class="slide-title">{{ slide.title }}</h2>
                        <p class="slide-description">{{ slide.description }}</p>
                        <a v-if="slide.link" :href="slide.link" class="view-more-link">Ver más</a>

                    </div>
                </div>
            </swiper-slide>
        </swiper>

        <!-- Custom Previous Button -->
        <button class="prev-button" @click="slidePrev">
            <i class="fas fa-chevron-left"></i>
        </button>

        <!-- Custom Next Button -->
        <button class="next-button" @click="slideNext">
            <i class="fas fa-chevron-right"></i>
        </button>
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

export default {
    components: {
        Swiper,
        SwiperSlide,
    },
    setup() {
        const swiperInstance = ref(null);
        const slides = ref([]); // Inicialmente vacío

        // Llamada a la API para obtener los datos del carrusel
        const fetchSlides = () => {
            axios.get('/api/carousels') // Asegúrate de que esta ruta es correcta
                .then(response => {
                    slides.value = response.data;
                })
                .catch(error => {
                    console.error("Error al obtener los slides:", error);
                });
        };

        onMounted(() => {
            fetchSlides(); // Llamada a la API cuando el componente se monta
        });

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

        const breakpoints = {
            640: {
                slidesPerView: 1,
                // spaceBetween: 20,
            },
            768: {
                slidesPerView: 1,
                // spaceBetween: 30,
            },
            1024: {
                slidesPerView: 1,
                // spaceBetween: 40,
            },
        };

        return {
            slideNext,
            slidePrev,
            onSwiper,
            slides,
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

.header-carousel-container {
    position: relative;
    width: 100%;
    height: 400px;
    display: flex;
    align-items: center;
    overflow: hidden;
}

.mySwiper {
    width: 100%;
    height: 100%;
}

.swiper-slide {
    display: flex;
    align-items: center;
}

.slide-content {
    position: relative;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
}

.slide-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.slide-text {
    position: absolute;
    top: 50%;
    left: 10%;
    transform: translateY(-50%);
    color: #fff;
    z-index: 5;
    max-width: 40%;
    padding: 20px;
    background: rgba(0, 0, 0, 0.5);
    border-radius: 10px;
}

.slide-title {
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.slide-description {
    font-size: 1.25rem;
    margin-bottom: 1rem;
}

.view-more-link {
    font-size: 1rem;
    color: #7d98f8;
    text-decoration: underline;
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
    z-index: 5;
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

@media screen and (max-width: 768px) {
    .slide-text {
        display: none;
    }
}
</style>
