<template>
  <div>
    <!-- Barra de búsqueda -->
    <div class="mb-4">
      <label for="busqueda" class="block text-lg font-medium text-gray-700 mb-2">Buscar producto</label>
      <input id="busqueda" type="text" v-model="busqueda" @input="filtrarProductos"
        placeholder="Ingrese el nombre o descripción del producto..."
        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out" />
    </div>

    <!-- Tabla de productos -->
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Imagen</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <tr v-for="producto in productosFiltrados" :key="producto.id">
          <td class="px-6 py-4 whitespace-nowrap">
            <img :src="producto.image" alt="Imagen del producto" class="w-24 h-24 object-cover">
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ producto.id }}</td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ producto.nombre }}</td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 truncate max-w-xs"
            title="{{ producto.descripcion }}">
            {{ producto.descripcion }}
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ producto.precio }}</td>
          <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
            <button @click="confirmarEliminacion(producto.id)" class="text-red-600 hover:text-red-900">Eliminar</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import Swal from 'sweetalert2';
import axios from 'axios';

export default {
  data() {
    return {
      productos: [],
      busqueda: '',
      productosFiltrados: []
    };
  },
  mounted() {
    this.obtenerProductos();
  },
  methods: {
    async obtenerProductos() {
      try {
        const response = await axios.get('/api/productosAll');
        this.productos = response.data.productos;
        this.productosFiltrados = this.productos; // Inicialmente, todos los productos están filtrados
      } catch (error) {
        console.error('Error al obtener los productos:', error);
      }
    },
    filtrarProductos() {
      const termino = this.busqueda.toLowerCase();
      this.productosFiltrados = this.productos.filter(producto => {
        return (
          producto.nombre.toLowerCase().includes(termino) ||
          producto.descripcion.toLowerCase().includes(termino) ||
          producto.id.toString().includes(termino)
        );
      });
    },
    async confirmarEliminacion(id) {
      const { value: confirm } = await Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás recuperar este producto después de eliminarlo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo',
        cancelButtonText: 'Cancelar'
      });

      if (confirm) {
        this.eliminarProducto(id);
      }
    },
    async eliminarProducto(id) {
      try {
        await axios.delete(`/api/productos/${id}`);
        this.obtenerProductos(); // Volver a cargar la lista de productos
        Swal.fire(
          'Eliminado!',
          'El producto ha sido eliminado.',
          'success'
        );
      } catch (error) {
        Swal.fire(
          'Error!',
          'Hubo un problema al eliminar el producto.',
          'error'
        );
      }
    }
  }
};
</script>

<style scoped>
/* Ajustes opcionales para la tabla */
.truncate {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
</style>
