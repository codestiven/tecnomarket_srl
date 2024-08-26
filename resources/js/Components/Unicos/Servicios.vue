<template>

    <Titulo titulo="Servicios" />

    <div class="parent">

        <div class="child-3">
            Hijo 1 (3/12)
        </div>

        <div class="child-9">
            <div class="child-9-half child-9-half-1">
                Hijo 2.1 (1/2)
            </div>
            <div class="child-9-half child-9-half-2">
                Hijo 2.2 (1/2)
            </div>
        </div>

    </div>
</template>

<script setup>
import Titulo from "@/Components/Titulos.vue";

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
    background-color: #f87171;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 40px;


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
}

.child-9-half-1 {
    background-color: #60a5fa;
}

.child-9-half-2 {
    background-color: #34d399;
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
