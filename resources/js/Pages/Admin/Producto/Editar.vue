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
                <img :src="producto.image" alt="Producto" class="w-full h-48 object-cover mb-4">
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

<script>
import axios from 'axios';

export default {
    data() {
        return {
            productos: [],
            categorias: [],
            marcas: [],
            selectedProducto: null,
            errors: {},
            searchQuery: ''
        };
    },
    computed: {
        // Computed property to filter productos based on the search query
        filteredProductos() {
            const query = this.searchQuery.toLowerCase();
            return this.productos.filter(producto =>
                producto.nombre.toLowerCase().includes(query) ||
                producto.descripcion.toLowerCase().includes(query)
            );
        }
    },
    mounted() {
        this.fetchProductos();
        this.fetchCategorias();
        this.fetchMarcas();
    },
    methods: {
        // Cargar productos desde la API
        fetchProductos() {
            axios.get('/api/productosAll')
                .then(response => {
                    this.productos = response.data.productos;
                })
                .catch(error => {
                    console.error('Error al cargar los productos:', error);
                });
        },
        // Cargar categorías desde la API
        fetchCategorias() {
            axios.get('/api/Categorias')
                .then(response => {
                    this.categorias = response.data.categorias;
                })
                .catch(error => {
                    console.error('Error al cargar las categorías:', error);
                });
        },
        // Cargar marcas desde la API
        fetchMarcas() {
            axios.get('/api/Marcas')
                .then(response => {
                    this.marcas = response.data.marcas;
                })
                .catch(error => {
                    console.error('Error al cargar las marcas:', error);
                });
        },
        // Seleccionar un producto para edición
        selectProducto(producto) {
            this.selectedProducto = { ...producto }; // Clonamos el objeto para evitar modificar el original
            this.errors = {}; // Resetear errores al seleccionar un nuevo producto
        },
        // Enviar formulario
        submitForm() {
            if (this.selectedProducto && this.selectedProducto.id) {
                axios.put(`/api/productos/${this.selectedProducto.id}`, this.selectedProducto)
                    .then(response => {
                        alert('Producto actualizado correctamente');
                        this.fetchProductos(); // Volver a cargar la lista de productos
                        this.selectedProducto = null; // Limpiar selección
                        this.errors = {}; // Limpiar errores
                    })
                    .catch(error => {
                        if (error.response && error.response.data.errors) {
                            this.errors = error.response.data.errors; // Asignar errores de validación
                        } else {
                            console.error('Error al actualizar el producto:', error);
                        }
                    });
            } else {
                console.error('No se ha seleccionado un producto válido.');
            }
        },
        // Cancelar edición y mostrar lista de productos
        cancelEdit() {
            this.selectedProducto = null;
        }
    }
};
</script>

<style scoped>
.container {
    max-width: 1200px;
}

.descripcion {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 3;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
