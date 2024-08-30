<template>
    <div class="whatsapp-container">
        <a href="https://api.whatsapp.com/message/7KOXF7A2IYJBM1?autoload=1&app_absent=0" target="_blank"
            rel="noopener noreferrer" class="whatsapp-button" aria-label="Contacta con nosotros por WhatsApp">
            <i class="fa-brands fa-whatsapp whatsapp-icon"></i>
        </a>
    </div>
</template>

<script>
export default {
    name: "WhatsappButton",
};
</script>

<style scoped>
.whatsapp-container {
    position: fixed;
    bottom: 20px;
    /* Espacio desde el borde inferior */
    right: 20px;
    /* Espacio desde el borde derecho */
    z-index: 9;
    /* Asegura que esté por encima de todos los elementos */
}

.whatsapp-button {
    width: 90px;
    height: 90px;
    background-color: #25d366;
    /* Color verde de WhatsApp */
    border-radius: 50%;
    /* Hace el botón perfectamente circular */
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background-color 0.3s ease;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    /* Añade sombra para un efecto de elevación */
}

.whatsapp-button:hover {
    background-color: #1ebe5b;
    /* Color más oscuro al hacer hover */
}

.whatsapp-icon {
    color: white;
    font-size: 48px;
    /* Tamaño grande para el ícono */
    animation: bounce 2s infinite;
}

@keyframes bounce {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-10px);
    }
}

/* Media query para pantallas de tabletas y menores */
@media (max-width: 768px) {
    .whatsapp-button {
        width: 15vw;
        /* Tamaño relativo al ancho de la ventana */
        height: 15vw;
        /* Mantiene la proporción circular */
        max-width: 90px;
        /* Tamaño máximo */
        max-height: 90px;
        /* Tamaño máximo */
    }

    .whatsapp-icon {
        font-size: 8vw;

    }
}
</style>
