<template>
  <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Crear Producto</h1>

    <form @submit.prevent="submitForm" class="space-y-4">
      <!-- Campos del formulario -->
      <div>
        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
        <input v-model="producto.nombre" id="nombre" type="text"
          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" />
      </div>
      <div>
        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
        <textarea v-model="producto.descripcion" id="descripcion"
          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"></textarea>
      </div>
      <div>
        <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
        <input v-model.number="producto.precio" id="precio" type="number" step="0.01"
          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" />
      </div>
      <div>
        <label for="categoria_id" class="block text-sm font-medium text-gray-700">Categoría</label>
        <select v-model="producto.categoria_id" id="categoria_id"
          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
          <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">
            {{ categoria.nombre }}
          </option>
        </select>
      </div>
      <div>
        <label for="marca_id" class="block text-sm font-medium text-gray-700">Marca</label>
        <select v-model="producto.marca_id" id="marca_id"
          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
          <option v-for="marca in marcas" :key="marca.id" :value="marca.id">
            {{ marca.nombre }}
          </option>
        </select>
      </div>

      <!-- Oferta -->
      <div>
        <label class="inline-flex items-center">
          <input v-model="producto.es_oferta" type="checkbox" class="form-checkbox" true-value="1" false-value="0" />
          <span class="ml-2 text-sm font-medium text-gray-700">Es oferta</span>
        </label>
      </div>

      <!-- Precio oferta (si aplica) -->
      <div v-if="producto.es_oferta">
        <label for="precio_oferta" class="block text-sm font-medium text-gray-700">Precio de Oferta</label>
        <input v-model.number="producto.precio_oferta" id="precio_oferta" type="number" step="0.01"
          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" />
      </div>

      <!-- Imagen -->
      <div>
        <label for="imagen" class="block text-sm font-medium text-gray-700">Imagen</label>
        <input @change="handleFileUpload" id="imagen" type="file"
          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" />
      </div>

      <!-- Botón de enviar -->
      <div>
        <button type="submit"
          class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-500 hover:bg-blue-600">
          Crear Producto
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      producto: {
        nombre: '',
        descripcion: '',
        precio: '',
        categoria_id: '',
        marca_id: '',
        es_oferta: false,
        precio_oferta: null,
        imagen: null,
      },
      categorias: [],
      marcas: [],
    };
  },
  mounted() {
    this.fetchCategorias();
    this.fetchMarcas();
  },
  methods: {
    async fetchCategorias() {
      try {
        const response = await axios.get('/api/Categorias');
        this.categorias = response.data.categorias || []; // Ajusta según la estructura de tu respuesta
      } catch (error) {
        console.error('Error al obtener categorías:', error);
      }
    },
    async fetchMarcas() {
      try {
        const response = await axios.get('/api/Marcas');
        this.marcas = response.data.marcas || []; // Ajusta según la estructura de tu respuesta
      } catch (error) {
        console.error('Error al obtener marcas:', error);
      }
    },
    handleFileUpload(event) {
      this.producto.imagen = event.target.files[0];
    },
    submitForm() {
      const formData = new FormData();
      formData.append('nombre', this.producto.nombre);
      formData.append('descripcion', this.producto.descripcion);
      formData.append('precio', this.producto.precio);
      formData.append('categoria_id', this.producto.categoria_id);
      formData.append('marca_id', this.producto.marca_id);
      formData.append('es_oferta', this.producto.es_oferta ? 1 : 0); // Asegurarse de enviar 1 o 0
      if (this.producto.es_oferta) {
        formData.append('precio_oferta', this.producto.precio_oferta);
      }
      if (this.producto.imagen) {
        formData.append('imagen', this.producto.imagen);
      }

      axios.post('/productos/create', formData)
        .then(response => {
          alert('Producto creado correctamente');
          this.resetForm();
        })
        .catch(error => {
          console.error('Error al crear producto:', error.response.data);
          alert('Error al crear el producto');
        });
    },
    resetForm() {
      this.producto = {
        nombre: '',
        descripcion: '',
        precio: '',
        categoria_id: '',
        marca_id: '',
        es_oferta: false,
        precio_oferta: null,
        imagen: null,
      };
    },
  },
};
</script>

<style scoped>
/* Agrega estilos adicionales si es necesario */
</style>
