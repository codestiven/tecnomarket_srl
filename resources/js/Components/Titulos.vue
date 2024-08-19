<template>
    <div class="elemento flex flex-col items-center">
        <h1 class="mb-4 " v-if="mostrarLinea"> {{ tituloConLinea }}</h1>
        <h1 class="mb-4 linea" v-else> {{ tituloSinLinea }}</h1>
        <h2 v-if="subtitulo">{{ subtitulo }}</h2>
    </div>
</template>

<script>
export default {
    props: {
        titulo: {
            type: String,
            required: true
        },
        subtitulo: {
            type: String,
        },
        mostrarLinea: {
            type: Boolean,
            default: true // Mostrar el título con línea por defecto
        }
    },
    computed: {
        tituloConLinea() {
            return this.titulo;
        },
        tituloSinLinea() {
            // Puedes ajustar el título sin la línea como prefieras
            return this.titulo;
        }
    }
}
</script>

<style scoped>
.elemento {
    margin: 20px 0px 50px 0px;
    position: relative; /* Para posicionar el pseudo-elemento */
}

.elemento h1 {
    font-size: 48px;
    color: #2B2B2B;
    font-weight: bold;
    text-align: center;
    position: relative; /* Para que el pseudo-elemento se posicione relativo a este */
}

.elemento .linea::after {
    content: '';
    position: absolute;
    width: calc(100% - 20px); /* Ajusta el tamaño de la línea */
    height: 3px; /* Grosor de la línea */
    background-color: var(--complementario-color); /* Color de la línea */
    bottom: -5px; /* Ajusta la posición vertical */
    left: 50%; /* Centra horizontalmente */
    transform: translateX(-50%); /* Centra horizontalmente */
    border-radius: 2px; /* Añade bordes redondeados */
}

.elemento h2 {
    font-size: 24px;
    color: #2b2b2bab;
    white-space: pre-wrap;
    text-align: center;
}
</style>
