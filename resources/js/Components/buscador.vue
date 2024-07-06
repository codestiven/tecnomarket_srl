<template>
    <div class="buscador">
        <input type="text" class="input-buscador" placeholder="Buscar...">
        <button>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-icon">
                <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path
                    d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
            </svg>
        </button>
    </div>
</template>

<script>
export default {
    // Componente Vue
}
</script>

<style>
.buscador {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.buscador input {
    width: 90%;
    border-radius: 5px 0 0 5px;
    border: none;
    outline: none;
    height: 40px;
    /* Ajusta la altura según tus necesidades */
}

.buscador button {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--complementario-color);
    width: 50px;
    padding: 0 15px;
    border-radius: 0 5px 5px 0;
    color: #fff;
    height: 40px;
    /* Debe coincidir con la altura del input */
}

.svg-icon {
    width: 25px;
    /* Ajusta el tamaño según tus necesidades */
    height: 25px;
    /* Ajusta el tamaño según tus necesidades */
    fill: #fff;
    /* Cambia el color del SVG a rojo */
}
</style>
