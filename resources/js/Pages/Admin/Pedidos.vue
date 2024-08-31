<template>
    <div class=" bg-gray-100 py-8 px-4">
        <div class="max-w-7xl mx-auto relative">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Gestión de Pedidos</h1>
            <!-- Botones de cambio de vista -->
            <div class="absolute top-4 right-4 flex space-x-2">
                <button @click="cambiarVista('porFecha')"
                    :class="{ 'bg-blue-600': vista === 'porFecha', 'bg-blue-300': vista !== 'porFecha' }"
                    class="text-white font-semibold text-lg py-3 px-6 rounded-lg shadow-md hover:bg-blue-700 transition-colors duration-300">
                    Por Fecha
                </button>
                <button @click="cambiarVista('porCarrito')"
                    :class="{ 'bg-blue-600': vista === 'porCarrito', 'bg-blue-300': vista !== 'porCarrito' }"
                    class="text-white font-semibold text-lg py-3 px-6 rounded-lg shadow-md hover:bg-blue-700 transition-colors duration-300">
                    Por Carrito
                </button>
            </div>
            <!-- Vista por fecha -->
            <div v-if="vista === 'porFecha'">
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
                                        <a v-if="pedido.usuario" :href="`/users/${pedido.usuario.id}`"
                                            class="text-blue-500 hover:underline">
                                            {{ pedido.usuario.name }}
                                        </a>
                                        <span v-else class="text-gray-500">Usuario no disponible</span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <a :href="`/Productos/${pedido.producto.id}`"
                                            class="text-blue-500 hover:underline">
                                            {{ pedido.producto ? pedido.producto.nombre : 'Producto no disponible' }}
                                        </a>
                                    </td>
                                    <td class="py-3 px-4">{{ formatDate(pedido.created_at) }}</td>
                                    <td class="py-3 px-4">
                                        <span :class="getStatusClass(pedido.estado)">
                                            {{ pedido.estado }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 flex justify-center space-x-2">
                                        <button @click="confirmarAccion(pedido, 'terminado')"
                                            class="bg-green-500 hover:bg-green-600 text-white font-semibold py-1 px-3 rounded">
                                            Terminar
                                        </button>
                                        <button @click="confirmarAccion(pedido, 'cancelado')"
                                            class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-3 rounded">
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
            <!-- Vista por carrito -->
            <div v-if="vista === 'porCarrito'">
                <div v-for="(pedidosPorCarrito, carritoId) in pedidosAgrupadosPorCarrito" :key="carritoId" class="mb-8">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-2xl font-semibold text-gray-700 flex items-center">
                            <i class="fa-solid fa-cart-shopping mr-2 text-xl"></i> Carrito: {{ carritoId }}
                        </h2>
                        <div class="flex items-center space-x-2">
                            <i class="fa-solid fa-user text-gray-600 text-2xl"></i>
                            <span class="text-gray-700 text-lg">
                                <a v-if="pedidosPorCarrito.length > 0 && pedidosPorCarrito[0].usuario"
                                    :href="`/users/${pedidosPorCarrito[0].usuario.id}`"
                                    class="text-blue-500 hover:underline">
                                    {{ pedidosPorCarrito[0].usuario.name }}
                                </a>
                                <span v-else class="text-gray-500">Usuario no disponible</span>
                            </span>
                        </div>
                    </div>
                    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-700">
                                    <th class="py-3 px-4 border-b">ID</th>
                                    <th class="py-3 px-4 border-b">Producto</th>
                                    <th class="py-3 px-4 border-b">Fecha del Pedido</th>
                                    <th class="py-3 px-4 border-b">Estado</th>
                                    <th class="py-3 px-4 border-b">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="pedido in pedidosPorCarrito" :key="pedido.id" class="text-center border-t">
                                    <td class="py-3 px-4">{{ pedido.id }}</td>
                                    <td class="py-3 px-4">
                                        <a :href="`/Productos/${pedido.producto.id}`"
                                            class="text-blue-500 hover:underline">
                                            {{ pedido.producto ? pedido.producto.nombre : 'Producto no disponible' }}
                                        </a>
                                    </td>
                                    <td class="py-3 px-4">{{ formatDate(pedido.created_at) }}</td>
                                    <td class="py-3 px-4">
                                        <span :class="getStatusClass(pedido.estado)">
                                            {{ pedido.estado }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 flex justify-center space-x-2">
                                        <button @click="confirmarAccion(pedido, 'terminado')"
                                            class="bg-green-500 hover:bg-green-600 text-white font-semibold py-1 px-3 rounded">
                                            Terminar
                                        </button>
                                        <button @click="confirmarAccion(pedido, 'cancelado')"
                                            class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-3 rounded">
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
            pedidosAgrupadosPorCarrito: {},
            vista: 'porFecha', // Estado inicial de la vista
        };
    },
    methods: {
        async fetchPedidos() {
            try {
                const response = await axios.get('/pedidos');
                this.pedidos = response.data;
                this.agruparPedidosPorFecha();
                this.agruparPedidosPorCarrito();
            } catch (error) {
                console.error('Error al obtener los pedidos:', error);
            }
        },
        agruparPedidosPorFecha() {
            // Agrupar pedidos por fecha
            const agrupados = this.pedidos.reduce((acc, pedido) => {
                const fecha = new Date(pedido.created_at).toLocaleDateString();
                if (!acc[fecha]) {
                    acc[fecha] = [];
                }
                acc[fecha].push(pedido);
                return acc;
            }, {});

            // Ordenar por estado
            for (const fecha in agrupados) {
                agrupados[fecha].sort((a, b) => {
                    const estadoOrden = { 'en proceso': 1, 'terminado': 2, 'cancelado': 3 };
                    return estadoOrden[a.estado] - estadoOrden[b.estado];
                });
            }

            this.pedidosAgrupados = agrupados;
        },
        agruparPedidosPorCarrito() {
            // Agrupar pedidos por carrito
            const agrupados = this.pedidos.reduce((acc, pedido) => {
                if (pedido.carrito_id) {
                    const carritoId = pedido.carrito_id;
                    if (!acc[carritoId]) {
                        acc[carritoId] = [];
                    }
                    acc[carritoId].push(pedido);
                }
                return acc;
            }, {});

            this.pedidosAgrupadosPorCarrito = agrupados;
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
        },
        cambiarVista(nuevaVista) {
            this.vista = nuevaVista;
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

.text-xl {
    font-size: 1.25rem;
    /* Tamaño más grande para íconos y texto */
}
</style>
