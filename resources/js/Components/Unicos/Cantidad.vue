<script>
import { ref, onMounted } from "vue";
import axios from "axios";

export default {
  setup() {
    // Referencias reactivas para almacenar los datos
    const total = ref(0); // Inicializa con 0
    const categorias = ref([]);
    const error = ref(null);

    // Método para obtener la cantidad total de productos
    const fetchTotal = async () => {
      try {
        const response = await axios.get("/api/ProductoCount");
        total.value = response.data.ProductosCount;
      } catch (err) {
        error.value = `Error al obtener la cantidad total de productos: ${err.message}`;
      }
    };

    // Método para obtener las categorías y la cantidad de productos
    const fetchCategorias = async () => {
      try {
        const response = await axios.get("/api/Categorias");
        categorias.value = response.data.categorias; // Ajusta la estructura de la respuesta
      } catch (err) {
        error.value = `Error al obtener las categorías: ${err.message}`;
      }
    };

    // Llama a los métodos cuando el componente se monta en el DOM
    onMounted(() => {
      fetchTotal();
      fetchCategorias();
    });

    // Retorna las referencias y métodos que deseas exponer en el componente
    return {
      total,
      categorias,
      error
    };
  },
};
</script>

<template>
  <div class="contenedor">
    <div class="contenedor_cantidad">
      <h3>{{ total }} Productos</h3>
    </div>

    <div v-if="error" class="error">
      <p>{{ error }}</p>
    </div>

    <div class="contenedor productos" v-if="!error">
      <h3>Productos</h3>
      <div class="cartas">
        <div v-for="categoria in categorias" :key="categoria.id" class="carta">
          <div class="carta_titulo">
            <p>{{ categoria.nombre }}</p>
          </div>
          <h4>{{ categoria.cantidad_productos }}</h4>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
.contenedor {
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: column;
}

.contenedor .contenedor_cantidad {
  padding: 0px 100px 20px 10px;
  font-size: 22px;
  color: rgb(37, 37, 37);
  text-align: start;
  font-weight: bold;

  
}

.contenedor .productos {
  width: 100%;
  min-height: 400px;
  background-color: #fff;
  border-radius: 25px;
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
  padding: 25px;
}

.contenedor .productos > h3 {
  padding: 00px 10px 20px 0px;
  font-size: 25px;
  color: rgb(37, 37, 37);
  text-align: start;
  font-weight: bold;
}

.contenedor .productos > h3::after {
  content: "";
  display: block;
  width: 60%;
  height: 3px;
  background-color: #222;
  margin-top: 6px;
  border-radius: 100px;
}

.contenedor .productos .carta {
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center; /* Centra verticalmente los elementos dentro de la tarjeta */
  padding: 0px 10px 10px 0px;
  font-size: 20px;
  color: rgb(53, 53, 53);
  text-align: start;
  margin-bottom: 15px;
}

.contenedor .productos .carta_titulo {
  flex: 1; /* Permite que el título tome el espacio disponible */
  overflow-wrap: break-word; /* Ajusta el texto largo */
  word-break: break-word; /* Ajusta el texto largo */

  
}

.contenedor .productos .carta p {
  margin: 0;
}

.contenedor .productos .carta h4 {
  background-color: #c2c2c2;
  color: #585858;
  border-radius: 100px;
  width: 30%;
  text-align: center;
  font-weight: bold;
}
</style>
