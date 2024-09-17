<template>
    <div class="elemento flex flex-col items-center">
        <h2 class="titulo" v-if="mostrarLinea"> {{ tituloConLinea }}</h2>
        <h2 class="titulo linea" v-else> {{ tituloSinLinea }}</h2>
        <h3 class="subtitulo" v-if="subtitulo">{{ subtitulo }}</h3>
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
            return this.titulo;
        }
    }
}
</script>

<style scoped>
.elemento {
    margin: 10px 0px 15px 0px;
    position: relative;
    /* Para posicionar el pseudo-elemento */
}

.elemento h2 {
    font-size: 44px;
    color: #2B2B2B;
    font-weight: bold;
    text-align: center;
    position: relative;
    /* Para que el pseudo-elemento se posicione relativo a este */
}

.elemento .linea::after {
    content: '';
    position: absolute;
    width: calc(100% - 20px);
    /* Ajusta el tamaño de la línea */
    height: 3px;
    /* Grosor de la línea */
    background-color: var(--complementario-color);
    /* Color de la línea */
    bottom: -5px;
    /* Ajusta la posición vertical */
    left: 50%;
    /* Centra horizontalmente */
    transform: translateX(-50%);
    /* Centra horizontalmente */
    border-radius: 2px;
    /* Añade bordes redondeados */
}

.elemento h3 {
    font-size: 23px;
    color: #2b2b2bab;
    white-space: pre-wrap;
    text-align: center;
}

/* Media query para ocultar elementos en pantallas pequeñas */
@media (max-width: 900px) {


    .elemento .subtitulo {
        display: none;
    }
}
</style>
