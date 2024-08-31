<template>
  <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Crear Producto</h1>

    <form @submit.prevent="submitForm" class="space-y-4">
      <!-- Campos del formulario -->
      <div>
        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
        <input v-model="producto.nombre" id="nombre" type="text" placeholder="Ej. MacBook Pro 16"
          :class="{ 'border-red-500': errors.nombre, 'border-gray-300': !errors.nombre }"
          class="mt-1 block w-full border rounded-md shadow-sm" />
        <p v-if="errors.nombre" class="text-red-500 text-sm">{{ errors.nombre[0] }}</p>
      </div>
      <div>
        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
        <textarea v-model="producto.descripcion" id="descripcion"
          placeholder="Ej. Laptop de alto rendimiento para profesionales."
          :class="{ 'border-red-500': errors.descripcion, 'border-gray-300': !errors.descripcion }"
          class="mt-1 block w-full border rounded-md shadow-sm"></textarea>
        <p v-if="errors.descripcion" class="text-red-500 text-sm">{{ errors.descripcion[0] }}</p>
      </div>
      <div>
        <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
        <input v-model.number="producto.precio" id="precio" type="number" step="0.01" placeholder="Ej. 2500.00"
          :class="{ 'border-red-500': errors.precio, 'border-gray-300': !errors.precio }"
          class="mt-1 block w-full border rounded-md shadow-sm" />
        <p v-if="errors.precio" class="text-red-500 text-sm">{{ errors.precio[0] }}</p>
      </div>
      <div>
        <label for="categoria_id" class="block text-sm font-medium text-gray-700">Categoría</label>
        <select v-model="producto.categoria_id" id="categoria_id"
          :class="{ 'border-red-500': errors.categoria_id, 'border-gray-300': !errors.categoria_id }"
          class="mt-1 block w-full border rounded-md shadow-sm">
          <option value="" disabled>Seleccione categoría</option>
          <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">
            {{ categoria.nombre }}
          </option>
        </select>
        <p v-if="errors.categoria_id" class="text-red-500 text-sm">{{ errors.categoria_id[0] }}</p>
      </div>
      <div>
        <label for="marca_id" class="block text-sm font-medium text-gray-700">Marca</label>
        <select v-model="producto.marca_id" id="marca_id"
          :class="{ 'border-red-500': errors.marca_id, 'border-gray-300': !errors.marca_id }"
          class="mt-1 block w-full border rounded-md shadow-sm">
          <option value="" disabled>Seleccione marca</option>
          <option v-for="marca in marcas" :key="marca.id" :value="marca.id">
            {{ marca.nombre }}
          </option>
        </select>
        <p v-if="errors.marca_id" class="text-red-500 text-sm">{{ errors.marca_id[0] }}</p>
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
          placeholder="Ej. 2000.00"
          :class="{ 'border-red-500': errors.precio_oferta, 'border-gray-300': !errors.precio_oferta }"
          class="mt-1 block w-full border rounded-md shadow-sm" />
        <p v-if="errors.precio_oferta" class="text-red-500 text-sm">{{ errors.precio_oferta[0] }}</p>
      </div>

      <!-- Imagen -->
      <div>
        <label for="imagen" class="block text-sm font-medium text-gray-700">Imagen</label>
        <input @change="handleFileUpload" id="imagen" type="file" accept="image/*"
          :class="{ 'border-red-500': errors.imagen, 'border-gray-300': !errors.imagen }"
          class="mt-1 block w-full border rounded-md shadow-sm" />
        <p v-if="errors.imagen" class="text-red-500 text-sm">{{ errors.imagen[0] }}</p>
      </div>

      <!-- Toggle Detalles del Producto -->
      <div class="border border-gray-300 rounded-md shadow-sm">
        <button type="button" @click="toggleDetails"
          class="w-full px-4 py-2 text-left bg-gray-100 hover:bg-gray-200 rounded-t-md focus:outline-none">
          <span class="text-lg font-medium">Detalles del Producto</span>
          <svg :class="{ 'rotate-180': showDetails }" class="inline w-5 h-5 float-right transition-transform"
            fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
          </svg>
        </button>
        <div v-show="showDetails" class="p-4 bg-gray-50 rounded-b-md">
          <!-- Campos adicionales para DetallesProducto -->
          <div>
            <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
            <input v-model="producto.color" id="color" type="text" placeholder="Ej. Plata"
              :class="{ 'border-red-500': errors.color, 'border-gray-300': !errors.color }"
              class="mt-1 block w-full border rounded-md shadow-sm" />
            <p v-if="errors.color" class="text-red-500 text-sm">{{ errors.color[0] }}</p>
          </div>
          <div>
            <label for="peso" class="block text-sm font-medium text-gray-700">Peso</label>
            <input v-model.number="producto.peso" id="peso" type="number" step="0.01" placeholder="Ej. 2.0"
              :class="{ 'border-red-500': errors.peso, 'border-gray-300': !errors.peso }"
              class="mt-1 block w-full border rounded-md shadow-sm" />
            <p v-if="errors.peso" class="text-red-500 text-sm">{{ errors.peso[0] }}</p>
          </div>
          <div>
            <label for="pantalla" class="block text-sm font-medium text-gray-700">Pantalla</label>
            <input v-model="producto.pantalla" id="pantalla" type="text" placeholder="Ej. 16 pulgadas"
              :class="{ 'border-red-500': errors.pantalla, 'border-gray-300': !errors.pantalla }"
              class="mt-1 block w-full border rounded-md shadow-sm" />
            <p v-if="errors.pantalla" class="text-red-500 text-sm">{{ errors.pantalla[0] }}</p>
          </div>
          <div>
            <label for="sistema_operativo" class="block text-sm font-medium text-gray-700">Sistema Operativo</label>
            <select v-model="producto.sistema_operativo" id="sistema_operativo"
              :class="{ 'border-red-500': errors.sistema_operativo, 'border-gray-300': !errors.sistema_operativo }"
              class="mt-1 block w-full border rounded-md shadow-sm">
              <option value="Windows 11">Windows 11</option>
              <option value="Windows 10">Windows 10</option>
              <option value="Windows 8">Windows 8</option>
              <option value="Windows 7">Windows 7</option>
              <option value="Android">Android</option>
              <option value="macOS">macOS</option>
              <option value="Apple">Apple</option>
              <option value="Otros">Otros</option>
            </select>
            <p v-if="errors.sistema_operativo" class="text-red-500 text-sm">{{ errors.sistema_operativo[0] }}</p>
          </div>
          <div>
            <label for="procesador" class="block text-sm font-medium text-gray-700">Procesador</label>
            <input v-model="producto.procesador" id="procesador" type="text" placeholder="Ej. Intel Core i9"
              :class="{ 'border-red-500': errors.procesador, 'border-gray-300': !errors.procesador }"
              class="mt-1 block w-full border rounded-md shadow-sm" />
            <p v-if="errors.procesador" class="text-red-500 text-sm">{{ errors.procesador[0] }}</p>
          </div>
          <div>
            <label for="ram" class="block text-sm font-medium text-gray-700">RAM</label>
            <input v-model.number="producto.ram" id="ram" type="number" step="1" placeholder="Ej. 16"
              :class="{ 'border-red-500': errors.ram, 'border-gray-300': !errors.ram }"
              class="mt-1 block w-full border rounded-md shadow-sm" />
            <p v-if="errors.ram" class="text-red-500 text-sm">{{ errors.ram[0] }}</p>
          </div>
          <div>
            <label for="almacenamiento" class="block text-sm font-medium text-gray-700">Almacenamiento</label>
            <input v-model.number="producto.almacenamiento" id="almacenamiento" type="number" step="1"
              placeholder="Ej. 512"
              :class="{ 'border-red-500': errors.almacenamiento, 'border-gray-300': !errors.almacenamiento }"
              class="mt-1 block w-full border rounded-md shadow-sm" />
            <p v-if="errors.almacenamiento" class="text-red-500 text-sm">{{ errors.almacenamiento[0] }}</p>
          </div>
          <div>
            <label for="tipo_de_almacenamiento" class="block text-sm font-medium text-gray-700">Tipo de
              Almacenamiento</label>
            <select v-model="producto.tipo_de_almacenamiento" id="tipo_de_almacenamiento"
              :class="{ 'border-red-500': errors.tipo_de_almacenamiento, 'border-gray-300': !errors.tipo_de_almacenamiento }"
              class="mt-1 block w-full border rounded-md shadow-sm">
              <option value="SSD">SSD</option>
              <option value="HDD">HDD</option>
            </select>
            <p v-if="errors.tipo_de_almacenamiento" class="text-red-500 text-sm">{{ errors.tipo_de_almacenamiento[0] }}
            </p>
          </div>
          <div>
            <label for="tarjeta_grafica" class="block text-sm font-medium text-gray-700">Tarjeta Gráfica</label>
            <input v-model="producto.tarjeta_grafica" id="tarjeta_grafica" type="text"
              placeholder="Ej. NVIDIA GeForce RTX 3080"
              :class="{ 'border-red-500': errors.tarjeta_grafica, 'border-gray-300': !errors.tarjeta_grafica }"
              class="mt-1 block w-full border rounded-md shadow-sm" />
            <p v-if="errors.tarjeta_grafica" class="text-red-500 text-sm">{{ errors.tarjeta_grafica[0] }}</p>
          </div>
          <div>
            <label for="consumo_energetico" class="block text-sm font-medium text-gray-700">Consumo Energético</label>
            <input v-model.number="producto.consumo_energetico" id="consumo_energetico" type="number" step="0.01"
              placeholder="Ej. 90"
              :class="{ 'border-red-500': errors.consumo_energetico, 'border-gray-300': !errors.consumo_energetico }"
              class="mt-1 block w-full border rounded-md shadow-sm" />
            <p v-if="errors.consumo_energetico" class="text-red-500 text-sm">{{ errors.consumo_energetico[0] }}</p>
          </div>
        </div>
      </div>

      <button type="submit"
        class="w-full px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
        Crear Producto
      </button>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';

// Definición de datos reactivos
const producto = ref({
  nombre: '',
  descripcion: '',
  precio: null,
  categoria_id: '',
  marca_id: '',
  es_oferta: '',
  precio_oferta: '',
  imagen: null,
  color: '',
  peso: 0,
  pantalla: '',
  sistema_operativo: 'Otros',
  procesador: '',
  ram: 0,
  almacenamiento: 0,
  tipo_de_almacenamiento: 'SSD', // Valor por defecto
  tarjeta_grafica: '',
  consumo_energetico: 0,
});

const categorias = ref([]);
const marcas = ref([]);
const showDetails = ref(false);
const errors = ref({}); // Manejo de errores

// Métodos
async function submitForm() {
  try {
    const formData = new FormData();
    Object.keys(producto.value).forEach(key => {
      formData.append(key, producto.value[key]);
    });

    await axios.post('/productos/create', formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    });

    Swal.fire({
      title: 'Éxito',
      text: 'Producto creado correctamente',
      icon: 'success',
      confirmButtonText: 'Aceptar'
    });

    // Limpia los errores después de un envío exitoso
    errors.value = {};
  } catch (error) {
    console.error('Error al crear el producto:', error);

    // Maneja los errores específicos
    if (error.response && error.response.status === 422) {
      errors.value = error.response.data.errors || {};
    }

    Swal.fire({
      title: 'Error',
      text: 'No se pudo crear el producto',
      icon: 'error',
      confirmButtonText: 'Aceptar'
    });
  }
}

function handleFileUpload(event) {
  producto.value.imagen = event.target.files[0];
}

function toggleDetails() {
  showDetails.value = !showDetails.value;
}

// Cargar categorías y marcas en el montaje del componente
onMounted(async () => {
  try {
    const responseCategorias = await axios.get('/api/Categorias');
    categorias.value = responseCategorias.data.categorias || []; // Ajusta según la estructura de tu respuesta
  } catch (error) {
    console.error('Error al cargar categorías:', error);
  }

  try {
    const responseMarcas = await axios.get('/api/Marcas');
    marcas.value = responseMarcas.data.marcas || [];
    console.log(marcas.value);
  } catch (error) {
    console.error('Error al cargar marcas:', error);
  }
});
</script>


<style scoped>
.border-red-500 {
  border-color: #f87171;
}
</style>
