<template>
    <div class="min-h-screen bg-gray-100 py-8 px-4">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Gestión de Pedidos</h1>
            <div v-for="(pedidosPorFecha, fecha) in pedidosAgrupados" :key="fecha" class="mb-8">
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">{{ fecha }}</h2>
                <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-700">
                                <th class="py-3 px-4 border-b">ID</th>
                                <th class="py-3 px-4 border-b">Usuario</th>
                                <th class="py-3 px-4 border-b">Producto</th>
                                <th class="py-3 px-4 border-b">Fecha del Pedido</th>
                                <th class="py-3 px-4 border-b">Estado</th>
                                <th class="py-3 px-4 border-b">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="pedido in pedidosPorFecha" :key="pedido.id" class="text-center border-t">
                                <td class="py-3 px-4">{{ pedido.id }}</td>
                                <td class="py-3 px-4">
                                    <a :href="`/users/${pedido.usuario.id}`" class="text-blue-500 hover:underline">
                                        {{ pedido.usuario ? pedido.usuario.name : 'Usuario no disponible' }}
                                    </a>
                                </td>
                                <td class="py-3 px-4">
                                    <a :href="`/Productos/${pedido.producto.id}`" class="text-blue-500 hover:underline">
                                        {{ pedido.producto ? pedido.producto.nombre : 'Producto no disponible' }}
                                    </a>
                                </td>
                                <td class="py-3 px-4">{{ formatDate(pedido.created_at) }}</td>
                                <td class="py-3 px-4">
                                    <span :class="getStatusClass(pedido.estado)">
                                        {{ pedido.estado }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 flex justify-center">
                                    <button @click="confirmarAccion(pedido, 'terminado')"
                                        class="bg-green-500 hover:bg-green-600 text-white font-semibold py-1 px-3 rounded mr-2">
                                        Terminar
                                    </button>
                                    <button @click="confirmarAccion(pedido, 'cancelado')"
                                        class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-3 rounded mr-2">
                                        Cancelar
                                    </button>
                                    <button @click="confirmarAccion(pedido, 'borrar')"
                                        class="text-gray-500 hover:text-gray-700 text-xl font-bold">
                                        &times;
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
    data() {
        return {
            pedidos: [],
            pedidosAgrupados: {},
        };
    },
    methods: {
        async fetchPedidos() {
            try {
                const response = await axios.get('/pedidos');
                this.pedidos = response.data;
                this.agruparPedidosPorFecha();
            } catch (error) {
                console.error('Error al cargar los pedidos:', error);
            }
        },
        agruparPedidosPorFecha() {
            // Agrupar pedidos por fecha
            const agrupados = this.pedidos.reduce((acc, pedido) => {
                const fecha = this.formatDate(pedido.created_at);
                if (!acc[fecha]) {
                    acc[fecha] = [];
                }
                acc[fecha].push(pedido);
                return acc;
            }, {});

            // Ordenar los pedidos dentro de cada fecha
            for (const fecha in agrupados) {
                agrupados[fecha] = agrupados[fecha].sort((a, b) => {
                    const estadoOrden = { 'en proceso': 1, 'terminado': 2, 'cancelado': 3 };
                    return estadoOrden[a.estado] - estadoOrden[b.estado];
                });
            }

            this.pedidosAgrupados = agrupados;
        },
        getStatusClass(status) {
            switch (status) {
                case 'en proceso':
                    return 'bg-yellow-500 text-white px-2 py-1 rounded';
                case 'terminado':
                    return 'bg-green-500 text-white px-2 py-1 rounded';
                case 'cancelado':
                    return 'bg-red-500 text-white px-2 py-1 rounded';
                default:
                    return '';
            }
        },
        async confirmarAccion(pedido, accion) {
            const mensaje = accion === 'borrar'
                ? '¿Estás seguro de que deseas borrar este pedido?'
                : `¿Estás seguro de que deseas marcar este pedido como ${accion}?`;

            const resultado = await Swal.fire({
                title: 'Confirmar Acción',
                text: mensaje,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, proceder',
                cancelButtonText: 'Cancelar'
            });

            if (resultado.isConfirmed) {
                if (accion === 'borrar') {
                    this.eliminarPedido(pedido.id);
                } else {
                    this.cambiarEstado(pedido, accion);
                }
            }
        },
        async cambiarEstado(pedido, estado) {
            try {
                await axios.put(`/pedidos/${pedido.id}`, { estado });
                this.fetchPedidos();
                Swal.fire('Actualizado', `El estado del pedido ha sido cambiado a ${estado}.`, 'success');
            } catch (error) {
                console.error('Error al actualizar el estado:', error);
                Swal.fire('Error', 'Hubo un problema al actualizar el estado.', 'error');
            }
        },
        async eliminarPedido(id) {
            try {
                await axios.delete(`/pedidos/${id}`);
                this.fetchPedidos();
                Swal.fire('Borrado', 'El pedido ha sido eliminado exitosamente.', 'success');
            } catch (error) {
                console.error('Error al borrar el pedido:', error);
                Swal.fire('Error', 'Hubo un problema al borrar el pedido.', 'error');
            }
        },
        formatDate(date) {
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return new Date(date).toLocaleDateString(undefined, options);
        }
    },
    mounted() {
        this.fetchPedidos();
    },
};
</script>

<style scoped>
.min-h-screen {
    min-height: 100vh;
}
</style>
