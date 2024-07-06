<template>
    <button class="" @click="onClick">
        <slot />
    </button>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    onClick: Function // Propiedad onClick que espera una función
});

// Función para manejar el clic en el botón
const onClick = () => {
    if (typeof props.onClick === 'function') {
        props.onClick(); // Ejecutar la función onClick pasada como propiedad
    }
}
</script>

<style scoped>
button {
    background-color: var(--secondary-color);
    padding: 10px 20px ;
    border-radius: 50px;
    color: white;
    font-weight:400;
    font-size: 20px;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 5px;
    fill: #fff;
}

button:hover {
    transform: scale(1.3);
}

button:active {
    transform: scale(0.9);
}
</style>
