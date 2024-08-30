<template>
    <div v-if="isVisible" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div
            class="popup-container relative bg-white rounded-lg shadow-lg w-full max-w-xl h-96 flex flex-col items-center justify-center p-4">
            <!-- Título, fuera de la caja principal -->
            <h2 class="popup-title absolute text-3xl font-bold text-white text-center">¿Cómo deseas comprar?</h2>

            <!-- Contenedor de opciones -->
            <div class="w-full h-full flex overflow-hidden">
                <!-- Opción de WhatsApp -->
                <div @click="whatsappAction"
                    class="popup-option flex-1 flex flex-col items-center justify-center cursor-pointer transition-colors duration-300 bg-white rounded-lg m-2">
                    <i class="fa-brands fa-whatsapp text-6xl icon whatsapp-icon transition duration-300"></i>
                    <span class="text-2xl mt-4 font-bold whatsapp-text transition duration-300">WhatsApp</span>
                </div>

                <!-- Opción de Usar Cuenta -->
                <div @click="accountAction"
                    class="popup-option flex-1 flex flex-col items-center justify-center cursor-pointer transition-colors duration-300 bg-white rounded-lg m-2">
                    <i class="fa-solid fa-user text-6xl icon account-icon transition duration-300"></i>
                    <span class="text-2xl mt-4 font-bold account-text transition duration-300">Usar Cuenta</span>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    props: {
        isVisible: {
            type: Boolean,
            required: true,
        },
    },
    methods: {
        whatsappAction() {
            // Lógica para la acción de WhatsApp
            console.log('WhatsApp clicked');
            this.$emit('close');
        },
        accountAction() {
            // Lógica para la acción de Usar Cuenta
            console.log('Account clicked');
            this.$emit('close');
        },
    },
};
</script>

<style scoped>
/* Estilo general del popup */
.fixed {
    position: fixed;
    inset: 0;
    z-index: 999999999999999999999999999999999999999999999999999999;
    /* Asegúrate de que sea mayor que cualquier otro elemento en la página */
}

/* Contenedor del popup */
.popup-container {
    width: 90%;
    max-width: 600px;
    height: 400px;
    display: flex;
    flex-direction: column;
    padding: 20px;
    position: relative;
    border-radius: 1rem;
}

/* Estilo del título */
.popup-title {
    top: -3rem;
    font-size: 2.5rem;
    color: white;
    margin: 0;
}

/* Estilo de las opciones */
.popup-option {
    display: flex;
    align-items: center;
    justify-content: center;
    flex: 1;
    transition: background-color 0.3s ease;
    margin: 0.5rem;
    border-radius: 0.75rem;
}

.whatsapp-icon {
    color: #25D366;
}

.account-icon {
    color: #007BFF;
}

.whatsapp-text {
    color: #25D366;
}

.account-text {
    color: #007BFF;
}

.popup-option:hover {
    background-color: #f0f0f0;
}

.popup-option:first-child:hover {
    background: rgb(157, 211, 37);
    background: linear-gradient(35deg, rgba(157, 211, 37, 1) 13%, rgba(37, 211, 102, 1) 100%);
}

.popup-option:last-child:hover {
    background: rgb(0, 5, 255);
    background: linear-gradient(35deg, rgba(0, 5, 255, 1) 0%, rgba(0, 219, 255, 1) 100%);
}

.popup-option:first-child:hover .whatsapp-icon,
.popup-option:first-child:hover .whatsapp-text {
    color: white;
}

.popup-option:last-child:hover .account-icon,
.popup-option:last-child:hover .account-text {
    color: white;
}

.popup-option .icon,
.popup-option span {
    transition: color 0.3s ease;
}

/* Estilo responsivo para dispositivos móviles */
@media (max-width: 768px) {
    .popup-container {
        flex-direction: column;
        height: auto;
    }

    .popup-option {
        width: 100%;
        height: 100px;
    }

    .popup-title {
        font-size: 2rem;
    }
}
</style>
