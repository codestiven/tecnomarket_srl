<template>

    <button type="badges" class="badges relative inline-flex items-center p-3 text-sm font-medium text-center text-white  rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
       
<slot></slot>

        <span class="sr-only">Notifications</span>
        <div
            class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900">
            {{ badgeNumber }}</div>
    </button>

</template>

<script>
export default {
    props: {
        emojiSrc: {
            type: String,
            required: true
        },
        badgeNumber: {
            type: Number,
            default: 1
        }
    },
    data() {
        return {
            showBadge: true // Controla la visibilidad del círculo con número
        };
    },
    computed: {
        badgeSize() {
            // Calcular el tamaño del círculo en función del número de dígitos
            const digits = Math.max(String(Math.abs(this.badgeNumber)).length, 1);
            const baseSize = 1.2; // Tamaño mínimo base del círculo
            return `${baseSize + digits * 0.3}rem`; // Ajuste proporcional por cantidad de dígitos
        }
    }
};
</script>

<style scoped>
.badges  svg{
    transform: scale(2.5);
}
</style>
