<template>
    <div class="container mx-auto py-8">
        <!-- Barra de búsqueda -->
        <div class="mb-4">
            <input v-model="searchQuery" type="text" placeholder="Buscar productos..."
                class="w-full p-2 border rounded" />
        </div>

        <!-- Mostrar lista de productos solo si no hay un producto seleccionado -->
        <div v-if="!selectedProducto" class="grid grid-cols-3 gap-4">
            <div v-for="producto in filteredProductos" :key="producto.id" class="border rounded p-4 shadow"
                @click="selectProducto(producto)" style="cursor: pointer;">
                <img :src="producto.image" alt="Producto" class="w-full h-48 object-cover mb-4" loading="lazy">
                <h2 class="text-xl font-bold">{{ producto.nombre }}</h2>
                <p class="descripcion">{{ producto.descripcion }}</p>
                <p class="text-gray-700 font-bold">${{ producto.precio }}</p>
            </div>
        </div>

        <!-- Formulario para editar el producto seleccionado -->
        <div v-if="selectedProducto" class="mt-8 p-4 border rounded shadow">
            <h2 class="text-2xl font-bold mb-4">Editar Producto</h2>
            <form @submit.prevent="submitForm">
                <!-- Form fields remain the same -->
                <div class="mb-4">
                    <label class="block text-gray-700">Nombre</label>
                    <input type="text" v-model="selectedProducto.nombre" class="w-full p-2 border rounded" />
                    <span v-if="errors.nombre" class="text-red-500">{{ errors.nombre[0] }}</span>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Descripción</label>
                    <textarea v-model="selectedProducto.descripcion" class="w-full p-2 border rounded"></textarea>
                    <span v-if="errors.descripcion" class="text-red-500">{{ errors.descripcion[0] }}</span>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Precio</label>
                    <input type="number" v-model="selectedProducto.precio" class="w-full p-2 border rounded" />
                    <span v-if="errors.precio" class="text-red-500">{{ errors.precio[0] }}</span>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Categoría</label>
                    <select v-model="selectedProducto.categoria_id" class="w-full p-2 border rounded">
                        <option value="" disabled>Seleccionar categoría</option>
                        <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">
                            {{ categoria.nombre }}
                        </option>
                    </select>
                    <span v-if="errors.categoria_id" class="text-red-500">{{ errors.categoria_id[0] }}</span>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Marca</label>
                    <select v-model="selectedProducto.marca_id" class="w-full p-2 border rounded">
                        <option value="" disabled>Seleccionar marca</option>
                        <option v-for="marca in marcas" :key="marca.id" :value="marca.id">
                            {{ marca.nombre }}
                        </option>
                    </select>
                    <span v-if="errors.marca_id" class="text-red-500">{{ errors.marca_id[0] }}</span>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Es oferta</label>
                    <input type="checkbox" v-model="selectedProducto.es_oferta" />
                </div>
                <div v-if="selectedProducto.es_oferta" class="mb-4">
                    <label class="block text-gray-700">Precio de oferta</label>
                    <input type="number" v-model="selectedProducto.precio_oferta" class="w-full p-2 border rounded" />
                    <span v-if="errors.precio_oferta" class="text-red-500">{{ errors.precio_oferta[0] }}</span>
                </div>

                <!-- Toggle Detalles del Producto -->
                <div class="border border-gray-300 rounded-md shadow-sm">
                    <button type="button" @click="toggleDetails"
                        class="w-full px-4 py-2 text-left bg-gray-100 hover:bg-gray-200 rounded-t-md focus:outline-none">
                        <span class="text-lg font-medium">Detalles del Producto</span>
                        <svg :class="{ 'rotate-180': showDetails }"
                            class="inline w-5 h-5 float-right transition-transform" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div v-show="showDetails" class="p-4 bg-gray-50 rounded-b-md">
                        <!-- Campos adicionales para DetallesProducto -->
                        <div>
                            <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
                            <input v-model="selecteddetalles.color" id="color" type="text" placeholder="Ej. Plata"
                                class="mt-1 block w-full border rounded-md shadow-sm" />
                        </div>
                        <div>
                            <label for="peso" class="block text-sm font-medium text-gray-700">Peso</label>
                            <input v-model="selecteddetalles.peso" id=" peso" type="number" step="0.01" placeholder="Ej. 2.0"
                                class="mt-1 block w-full border rounded-md shadow-sm" />
                        </div>
                        <div>
                            <label for="pantalla" class="block text-sm font-medium text-gray-700">Pantalla</label>
                            <input v-model="selecteddetalles.pantalla" id="pantalla" type="text" placeholder="Ej. 16 pulgadas"
                                class="mt-1 block w-full border rounded-md shadow-sm" />
                        </div>
                        <div>
                            <label for="sistema_operativo" class="block text-sm font-medium text-gray-700">Sistema
                                Operativo</label>
                            <select v-model="selecteddetalles.sistema_operativo" id="sistema_operativo" class="mt-1 block w-full border rounded-md shadow-sm">
                                <option value="Windows 11">Windows 11</option>
                                <option value="Windows 10">Windows 10</option>
                                <option value="Windows 8">Windows 8</option>
                                <option value="Windows 7">Windows 7</option>
                                <option value="Android">Android</option>
                                <option value="macOS">macOS</option>
                                <option value="Apple">Apple</option>
                                <option value="Otros">Otros</option>
                            </select>
                        </div>
                        <div>
                            <label for="procesador" class="block text-sm font-medium text-gray-700">Procesador</label>
                            <input v-model="selecteddetalles.procesador" id="procesador" type="text" placeholder="Ej. Intel Core i9"
                                class="mt-1 block w-full border rounded-md shadow-sm" />
                        </div>
                        <div>
                            <label for="ram" class="block text-sm font-medium text-gray-700">RAM</label>
                            <input v-model="selecteddetalles.ram" id="ram" type="number" step="1" placeholder="Ej. 16"
                                class="mt-1 block w-full border rounded-md shadow-sm" />
                        </div>
                        <div>
                            <label for="almacenamiento"
                                class="block text-sm font-medium text-gray-700">Almacenamiento</label>
                            <input v-model="selecteddetalles.almacenamiento" id="almacenamiento" type="number" step="1" placeholder="Ej. 512"
                                class="mt-1 block w-full border rounded-md shadow-sm" />
                        </div>
                        <div>
                            <label for="tipo_de_almacenamiento" class="block text-sm font-medium text-gray-700">Tipo de
                                Almacenamiento</label>
                            <select  v-model="selecteddetalles.tipo_de_almacenamiento" id="tipo_de_almacenamiento" class="mt-1 block w-full border rounded-md shadow-sm">
                                <option value="SSD">SSD</option>
                                <option value="HDD">HDD</option>
                            </select>
                        </div>
                        <div>
                            <label for="tarjeta_grafica" class="block text-sm font-medium text-gray-700">Tarjeta
                                Gráfica</label>
                            <input v-model="selecteddetalles.tarjeta_grafica" id="tarjeta_grafica" type="text" placeholder="Ej. NVIDIA GeForce RTX 3080"
                                class="mt-1 block w-full border rounded-md shadow-sm" />
                        </div>
                        <div>
                            <label for="consumo_energetico" class="block text-sm font-medium text-gray-700">Consumo
                                Energético</label>
                            <input v-model.number="selecteddetalles.consumo_energetico" id="consumo_energetico" type="number" step="0.01" placeholder="Ej. 90"
                                class="mt-1 block w-full border rounded-md shadow-sm" />
                        </div>
                    </div>
                </div>

                <!-- Input para la imagen -->
                <div class="mb-4">
                    <label class="block text-gray-700">Imagen</label>
                    <input type="file" @change="handleImageChange" accept="image/*" class="w-full p-2 border rounded" />
                    <span v-if="errors.image" class="text-red-500">{{ errors.image[0] }}</span>
                </div>

                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                    Actualizar
                </button>
                <button type="button" @click="cancelEdit"
                    class="ml-2 bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">
                    Cancelar
                </button>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';



// Definición de datos reactivos
const showDetails = ref(false);

// Método para alternar la visibilidad del acordeón
function toggleDetails() {
    showDetails.value = !showDetails.value;
}

// State
const productos = ref([]);
const categorias = ref([]);
const marcas = ref([]);
const selectedProducto = ref(null);
const errors = ref({});
const searchQuery = ref('');
const detalles = ref({});
const  selecteddetalles = ref({});


// Computed property for filtered productos based on search query
const filteredProductos = computed(() => {
    const query = searchQuery.value.toLowerCase();
    return productos.value.filter(producto =>
        producto.nombre.toLowerCase().includes(query) ||
        producto.descripcion.toLowerCase().includes(query)
    );
});

// Fetch data when the component is mounted
onMounted(() => {
    fetchProductos();
    fetchCategorias();
    fetchMarcas();

});

// Methods
const fetchProductos = async () => {
    try {
        const response = await axios.get('/api/productosAll');
        productos.value = response.data.productos;
    } catch (error) {
        console.error('Error al cargar los productos:', error);
    }
};

const fetchCategorias = async () => {
    try {
        const response = await axios.get('/api/Categorias');
        categorias.value = response.data.categorias;
    } catch (error) {
        console.error('Error al cargar las categorías:', error);
    }
};

const fetchMarcas = async () => {
    try {
        const response = await axios.get('/api/Marcas');
        marcas.value = response.data.marcas;
    } catch (error) {
        console.error('Error al cargar las marcas:', error);
    }
};

const fetchDetalles = async (id) => {
    try {
        // Realizamos la solicitud GET con el id de producto
        const response = await axios.get(`/api/detalles-producto/${id}`);

        // Asignamos la respuesta a una variable (por ejemplo, detalles)
        detalles.value = response.data;
        
        selecteddetalles.value = {...detalles.value };
        console.log(selecteddetalles.value);
    } catch (error) {
        // En caso de error, se muestra el mensaje en consola
        console.error('Error al cargar los detalles del producto:', error);
    }
};


const selectProducto = (producto) => {
    selectedProducto.value = { ...producto }; // Clonamos el objeto para evitar modificar el original
    errors.value = {}; // Resetear errores al seleccionar un nuevo producto
    fetchDetalles(producto.id);
};

const handleImageChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        selectedProducto.value.nuevaImagen = file; // Asignamos el archivo al objeto
    }
};

const submitForm = async () => {
    if (selectedProducto.value && selectedProducto.value.id) {
        const formData = new FormData();

        // Datos del producto
        formData.append('nombre', selectedProducto.value.nombre || '');
        formData.append('descripcion', selectedProducto.value.descripcion || '');
        formData.append('precio', selectedProducto.value.precio || '');
        formData.append('categoria_id', selectedProducto.value.categoria_id || '');
        formData.append('marca_id', selectedProducto.value.marca_id || '');
        formData.append('es_oferta', selectedProducto.value.es_oferta ? 1 : 0);

        if (selectedProducto.value.es_oferta) {
            formData.append('precio_oferta', selectedProducto.value.precio_oferta || 0);
        }

        // Si hay una nueva imagen, la agregamos al FormData
        if (selectedProducto.value.nuevaImagen) {
            formData.append('image', selectedProducto.value.nuevaImagen);
        }

        // Datos de los detalles del producto
        for (const key in selecteddetalles.value) {
            if (Object.hasOwnProperty.call(selecteddetalles.value, key)) {
                formData.append(key, selecteddetalles.value[key] || '');
            }
        }

        formData.append('_method', 'PUT'); // Simular el PUT

        try {
            const response = await axios.post(`/api/productos/${selectedProducto.value.id}`, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });
                console.log('Respuesta de la API:', response.data);
            alert('Producto actualizado correctamente');
            fetchProductos(); // Volver a cargar los productos
            selectedProducto.value = null; // Limpiar formulario
            selecteddetalles.value = {}; // Limpiar detalles
            errors.value = {}; // Limpiar errores
        } catch (error) {
            if (error.response && error.response.data.errors) {
                errors.value = error.response.data.errors; // Mostrar errores de validación
            } else {
                console.error('Error al actualizar el producto:', error);
            }
        }
    } else {
        console.error('No se ha seleccionado un producto válido.');
    }
};

const cancelEdit = () => {
    selectedProducto.value = null;
};
</script>

