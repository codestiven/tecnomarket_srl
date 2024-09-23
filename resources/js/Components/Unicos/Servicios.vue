<template>

    <Titulo titulo="Nuestros Servicios" />

    <div class="parent">

        <div
            class="child-3 group relative overflow-hidden rounded-lg shadow-lg hover:shadow-2xl transition duration-300 transform hover:scale-105 cursor-pointer">
            <img src="/images/Soporte tecnico.jpg" alt="Soporte tecnico"
                class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:opacity-70 transition duration-300"
                loading="lazy" />
            <Link :href="route('Soporte_tecnico')"
                class="relative z-10 text-center p-4 flex flex-col items-center justify-center w-full h-full">
            <h2 class="text-white text-3xl md:text-4xl font-extrabold mb-2 drop-shadow-md">Soporte Técnico</h2>
            <p class="text-white text-xl md:text-2xl drop-shadow-md">Atención y solución de problemas técnicos.</p>
            </Link>



        </div>




        <div class="child-9">
            <div
                class="child-9-half group relative overflow-hidden rounded-lg shadow-lg hover:shadow-2xl transition duration-300 transform hover:scale-105 cursor-pointer">
                <img src="/images/Financiamiento.jpg" alt="Financiamiento Disponible"
                    class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:opacity-70 transition duration-300"
                    loading="lazy" />
                <Link :href="route('Financiamiento')"
                    class="relative z-10 text-center p-4 flex flex-col items-center justify-center w-full h-full">
                <h2 class="text-white text-3xl md:text-4xl font-extrabold mb-2 drop-shadow-md">Financiamiento
                    Disponible</h2>
                <p class="text-white text-xl md:text-2xl drop-shadow-md">Oportunidades de crédito a tu alcance.</p>
                </Link>

            </div>

            <div
                class="child-9-half child-9-half-2 group relative overflow-hidden rounded-lg shadow-lg hover:shadow-2xl transition duration-300 transform hover:scale-105 cursor-pointer">
                <img src="/images/Garantia.jpg" alt="Garantia"
                    class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:opacity-70 transition duration-300"
                    loading="lazy" />
                <Link :href="route('Garantia')"
                    class="relative z-10 text-center p-4 flex flex-col items-center justify-center w-full h-full">
                <h2 class="text-white text-3xl md:text-4xl font-extrabold mb-2 drop-shadow-md">Garantía</h2>
                <p class="text-white text-xl md:text-2xl drop-shadow-md">Cobertura y soporte de calidad asegurada.
                </p>
                </Link>
            </div>

        </div>

    </div>
</template>

<script setup>
import Titulo from "@/Components/Titulos.vue";
import { Link } from "@inertiajs/vue3";

</script>

<style scoped>
.parent {
    display: grid;
    grid-template-columns: repeat(12, 1fr);
    gap: 26px;
    padding: 0px 20px;
    box-sizing: border-box;
    height: 550px;
}

.child-3 {
    grid-column: span 4;
    background-color: #1c2c41;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 40px;
    text-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);


}

.child-9 {
    grid-column: span 8;
    display: flex;
    flex-direction: column;
    gap: 30px;
    padding: 10px;


}

.child-9-half {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 40px;
    background-color: #929937;
    text-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);
}

.child-9-half-1 {
    background-color: #60a5fa;
}

.child-9-half-2 {
    background-color: #1f491d;
}

@media (max-width: 768px) {
    .parent {
        grid-template-columns: repeat(12, 1fr);
    }

    .child-3 {
        display: none;
    }

    .child-9 {
        grid-column: span 12;
    }
}
</style>
