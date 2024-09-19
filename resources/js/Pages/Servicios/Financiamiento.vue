<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Head, Link } from "@inertiajs/vue3";
import Header from "@/Components/Principales/Header.vue";
import Footer from "@/Components/Principales/Footer.vue";
import Titulo from "@/Components/Titulos.vue";
import WhatsappButton from "@/Components/WhatsappButton.vue";


</script>

<template>
    <WhatsappButton />

    <Head title="Inicio" />



    <!-- --------------------------------------------------- header ------------------------------------- -->
    <Header></Header>

    <!-- --------------------------------------------------- Main ------------------------------------- -->

    <main>
        <h1>Financiamiento</h1>
    </main>
    <!-- -----------------------------------------------------  Footer ------------------------------------ -->
    <Footer></Footer>
</template>






<style scoped>

</style>
