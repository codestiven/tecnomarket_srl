<template>
    <div class="header-carousel-container">
        <!-- Swiper Component -->
        <swiper ref="swiper" :pagination="true" :slides-per-view="1" :space-between="30" :loop="true"
            :autoplay="autoplay" :modules="modules" :breakpoints="breakpoints" class="mySwiper" @swiper="onSwiper">
            <swiper-slide v-for="(slide, index) in slides" :key="index">
                <div class="slide-content">
                    <img :src="slide.image" alt="Slide Image" class="slide-image">
                    <div class="slide-text">
                        <h1 class="slide-title">{{ slide.title }}</h1>
                        <p class="slide-description">{{ slide.description }}</p>
                        <a :href="slide.link" class="view-more-link">Ver más</a>
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
        const slides = ref([
            {
                title: 'Laptop para Desarrollo Web',
                description: 'Una laptop perfecta para programadores, equipada con lo último en hardware y software.',
                image: 'https://static.vecteezy.com/system/resources/thumbnails/002/960/590/small/abstract-watercolor-texture-wallpaper-background-free-vector.jpg',
                link: '/laptops/web-development'
            },
            {
                title: 'Laptop para Marketing Digital',
                description: 'Optimizada para manejar campañas de marketing digital con alta eficiencia.',
                image: 'https://img.freepik.com/vector-gratis/fondo-futurista-tecnologia-degradada_23-2149115236.jpg',
                link: '/laptops/digital-marketing'
            },
            {
                title: 'Laptop para Diseño Gráfico',
                description: 'Equipado con una GPU potente, ideal para diseñadores gráficos y creadores de contenido.',
                image: 'https://miro.medium.com/v2/resize:fit:1024/1*vxjAHkrXbGG6gOiPZgjeZA.jpeg',
                link: '/laptops/graphic-design'
            },
            {
                title: 'Laptop para Electrónica',
                description: 'Perfecta para ingenieros electrónicos, con herramientas especializadas para desarrollo y pruebas.',
                image: 'https://www.mikeelectronica.com/cdn/shop/articles/B-MK_02_2121x.progressive.jpg?v=1607535378',
                link: '/laptops/electronics'
            },
            {
                title: 'Laptop para Tecnología de la Información',
                description: 'Ideal para profesionales de TI, con gran capacidad de almacenamiento y rendimiento.',
                image: 'https://media.wired.com/photos/64daad6b4a854832b16fd3bc/4:3/w_1787,h_1340,c_limit/How-to-Choose-a-Laptop-August-2023-Gear.jpg',
                link: '/laptops/it'
            },
            {
                title: 'Laptop para Innovación Tecnológica',
                description: 'La mejor elección para pioneros en tecnología, diseñada para soportar las últimas innovaciones.',
                image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStpKTecT68g8XQ5mXNZInylTDXRFq039kfw7uEJjCAcP8tnHlksD5XEdNfPHAeKTP4SA0&usqp=CAU',
                link: '/laptops/tech-innovation'
            }
        ]);



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
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 1,
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 1,
                spaceBetween: 40,
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
    height: auto;
    object-fit: cover;
}

.slide-text {
    position: absolute;
    top: 50%;
    left: 10%;
    transform: translateY(-50%);
    color: #fff;
    z-index: 10;
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
    z-index: 20;
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
