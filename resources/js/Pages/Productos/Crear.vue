<template>
  <form @submit.prevent="submitForm">
    <div>
      <label for="nombre">Nombre:</label>
      <input type="text" id="nombre" v-model="form.nombre" />
    </div>
    <div>
      <label for="descripcion">Descripción:</label>
      <textarea id="descripcion" v-model="form.descripcion"></textarea>
    </div>
    <div>
      <label for="precio">Precio:</label>
      <input type="number" id="precio" v-model.number="form.precio" />
    </div>
    <div>
      <label for="categoria">Categoría:</label>
      <select id="categoria" v-model="form.categoria_id">
        <option value="1">Categoría 1</option>
        <option value="2">Categoría 2</option>
        <!-- Opciones de categoría cargadas dinámicamente si es necesario -->
      </select>
    </div>
    <div>
      <label for="marca">Marca:</label>
      <select id="marca" v-model="form.marca_id">
        <option value="1">Marca 1</option>
        <option value="2">Marca 2</option>
        <!-- Opciones de marca cargadas dinámicamente si es necesario -->
      </select>
    </div>
    <div>
      <label for="oferta">Oferta:</label>
      <select id="oferta" v-model="form.oferta_id">
        <option value="1">Oferta 1</option>
        <option value="2">Oferta 2</option>
        <!-- Opciones de oferta cargadas dinámicamente si es necesario -->
      </select>
    </div>
    <div>
      <label for="imagen">Imagen:</label>
      <input type="file" id="imagen" ref="fileInput" @change="onFileChange" />
    </div>
    <button type="submit">Guardar Producto</button>
  </form>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
  nombre: '',
  descripcion: '',
  precio: 0,
  categoria_id: null,
  marca_id: null,
 oferta_id: null,
  imagen: null,
});

const submitForm = async () => {
  form.post(route('productos.create'), {
    onSuccess: () => {
      console.log('Producto creado correctamente');
    },
    onError: (errors) => {
      console.error('Error al crear el producto:', errors);
    },
  });
};

const onFileChange = (event) => {
  form.imagen = event.target.files[0];
};
</script>
