<script setup>
import { computed, onMounted, onUnmounted, watch } from 'vue';
import { Teleport, Transition } from 'vue';

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '2xl',
    },
    closeable: {
        type: Boolean,
        default: true,
    },
});

const emit = defineEmits(['close']);

watch(
    () => props.show,
    () => {
        if (props.show) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = null;
        }
    }
);

const close = () => {
    if (props.closeable) {
        emit('close');
    }
};

const closeOnEscape = (e) => {
    if (e.key === 'Escape' && props.show) {
        close();
    }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));

onUnmounted(() => {
    document.removeEventListener('keydown', closeOnEscape);
    document.body.style.overflow = null;
});

const maxWidthClass = computed(() => {
    return {
        sm: 'sm:max-w-sm',
        md: 'sm:max-w-md',
        lg: 'sm:max-w-lg',
        xl: 'sm:max-w-xl',
        '2xl': 'sm:max-w-2xl',
    }[props.maxWidth];
});
</script>

<template>
    <Teleport to="body">
        <Transition name="modal-overlay">
            <div v-show="show" class="fixed inset-0 flex items-center justify-center z-50 px-4 py-6 sm:px-0">
                <Transition name="modal-overlay">
                    <div v-show="show" class="fixed inset-0 bg-gray-500 opacity-75" @click="close"></div>
                </Transition>

                <Transition name="modal-content">
                    <div v-show="show" class="relative bg-white rounded-lg shadow-xl transform transition-all"
                        :class="maxWidthClass">
                        <slot v-if="show" />
                    </div>
                </Transition>
            </div>
        </Transition>
    </Teleport>
</template>

<style scoped>
/* Custom transition styles for the modal */
.modal-overlay-enter-active,
.modal-overlay-leave-active {
    transition: opacity 0.3s ease;
}

.modal-overlay-enter,
.modal-overlay-leave-to

/* .modal-overlay-leave-active in <2.1.8 */
    {
    opacity: 0;
}

.modal-content-enter-active,
.modal-content-leave-active {
    transition: opacity 0.3s ease, transform 0.3s ease;
}

.modal-content-enter,
.modal-content-leave-to

/* .modal-content-leave-active in <2.1.8 */
    {
    opacity: 0;
    transform: translateY(10px);
}
</style>
