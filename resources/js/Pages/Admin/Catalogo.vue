<template>
  <div class="container mx-auto py-8 px-4">
    <h2 class="text-3xl font-bold mb-6 text-center">Gestión de Categorías</h2>

    <!-- Formulario para agregar/editar categoría -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
      <h3 class="text-xl font-semibold mb-4 text-gray-700">
        {{ isEditMode ? 'Editar Categoría' : 'Agregar Nueva Categoría' }}
      </h3>
      <form @submit.prevent="submitForm" class="flex items-center">
        <input type="text" v-model="form.nombre" placeholder="Nombre de la categoría"
          class="flex-1 border border-gray-300 p-2 rounded-lg mr-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
          required>
        <button type="submit"
          class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 transition duration-200">
          {{ isEditMode ? 'Actualizar' : 'Agregar' }}
        </button>
        <button v-if="isEditMode" @click="resetForm"
          class="ml-4 bg-gray-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-gray-600 transition duration-200">
          Cancelar
        </button>
      </form>
    </div>

    <!-- Tabla para mostrar las categorías -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
      <table class="min-w-full">
        <thead class="bg-gray-50">
          <tr>
            <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID
            </th>
            <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Nombre</th>
            <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Cantidad de Productos</th>
            <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Acciones</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="categoria in categorias" :key="categoria.id">
            <td class="py-4 px-6">{{ categoria.id }}</td>
            <td class="py-4 px-6">{{ categoria.nombre }}</td>
            <td class="py-4 px-6">{{ categoria.cantidad_productos }}</td>
            <td class="py-4 px-6">
              <button @click="editarCategoria(categoria)"
                class="bg-yellow-400 text-white px-3 py-1 rounded-lg shadow-md hover:bg-yellow-500 transition duration-200 mr-2">
                Editar
              </button>
              <button @click="eliminarCategoria(categoria.id)"
                class="bg-red-500 text-white px-3 py-1 rounded-lg shadow-md hover:bg-red-600 transition duration-200">
                Eliminar
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
  data() {
    return {
      categorias: [],
      form: {
        id: null,
        nombre: '',
      },
      isEditMode: false,
    };
  },
  mounted() {
    this.cargarCategorias();
  },
  methods: {
    async cargarCategorias() {
      try {
        const response = await axios.get('/categorias');
        this.categorias = response.data.categorias;
      } catch (error) {
        console.error('Error al cargar categorías:', error);
        Swal.fire('Error', 'No se pudo cargar la lista de categorías.', 'error');
      }
    },
    async submitForm() {
      try {
        if (this.isEditMode) {
          await axios.put(`/categorias/${this.form.id}`, this.form);
          Swal.fire('Actualizado', 'La categoría ha sido actualizada correctamente.', 'success');
        } else {
          await axios.post('/categorias', this.form);
          Swal.fire('Agregado', 'La categoría ha sido agregada correctamente.', 'success');
        }
        this.cargarCategorias();
        this.resetForm();
      } catch (error) {
        console.error('Error al guardar categoría:', error);
        Swal.fire('Error', 'No se pudo guardar la categoría.', 'error');
      }
    },
    editarCategoria(categoria) {
      this.form = { ...categoria };
      this.isEditMode = true;
    },
    async eliminarCategoria(id) {
      try {
        const result = await Swal.fire({
          title: '¿Estás seguro?',
          text: '¡No podrás revertir esto!',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sí, eliminarlo!',
        });
        if (result.isConfirmed) {
          await axios.delete(`/categorias/${id}`);
          this.cargarCategorias();
          Swal.fire('Eliminado', 'La categoría ha sido eliminada.', 'success');
        }
      } catch (error) {
        console.error('Error al eliminar categoría:', error);
        Swal.fire('Error', 'No se pudo eliminar la categoría.', 'error');
      }
    },
    resetForm() {
      this.form = { id: null, nombre: '' };
      this.isEditMode = false;
    },
  },
};
</script>

<style scoped>
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

th,
td {
  text-align: left;
  padding: 8px;
  border-bottom: 1px solid #ddd;
}

button {
  border: none;
  cursor: pointer;
}

.bg-blue-500:hover,
.bg-red-500:hover,
.bg-yellow-400:hover,
.bg-gray-500:hover {
  opacity: 0.8;
}
</style>
