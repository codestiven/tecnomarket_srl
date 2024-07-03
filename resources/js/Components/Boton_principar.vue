<template>
    <button class="">
        <slot />
    </button>
</template>

<style scoped>
button {
    background-color: var(--secondary-color);
    padding: 10px;
    border-radius: 10px;
    color: white;
    font-weight: bold;
    font-size: 20px;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

button:hover{
    transform: scale(1.3);
}

button:active{
    transform: scale(0.9);
}

</style>

