<script>
import { ref } from "vue"; // Importa ref desde Vue para crear referencias reactivas

export default {
  setup() {
    // Crea una referencia reactiva llamada datos
    const Total = ref(999);
    // Crea una referencia reactiva para manejar errores
    const cantidad = ref(100);

    // Método para obtener datos de la API
    const fetchData = () => {
      axios
        .get("URL_DE_TU_API")
        .then((response) => {
          datos.value = response.data; // Guarda los datos recibidos en la referencia datos
        })
        .catch((err) => {
          error.value = err; // Captura errores si la solicitud falla
        });
    };

    // Llama a fetchData() cuando el componente se monta en el DOM
    fetchData();

    // Retorna los datos y métodos que deseas exponer en el componente
    return {
      Total,
      cantidad,
    };
  },
};
</script>

<template>
  <div class="contenedor">
    <div class="contenedor_cantidad">
      <h3>{{ Total }} Productos</h3>
    </div>

    <div class="contenedor productos">
      <h1>Productos</h1>
      <div class="cartas">
        <div class="carta">
          <h1>Laptos</h1>
          <p>{{ cantidad }}</p>
        </div>

        <div class="carta">
          <h1>Laptos</h1>
          <p>{{ cantidad }}</p>
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
  font-size: 25px;
  color: rgb(37, 37, 37);
  text-align: start;
}

.contenedor .productos {
  width: 100%;
  min-height: 400px;
  background-color: #fff;
  border-radius: 25px;
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
  padding: 25px;
}

.contenedor .productos > h1{
  padding: 00px 10px 20px 0px;
  font-size: 25px;
  color: rgb(37, 37, 37);
  text-align: start;
  font-weight: bold;

}

.contenedor .productos > h1::after {
  content: "";
  display: block;
  width: 60%;
  height: 3px;
  background-color: #222;
  margin-top: 6px;
  border-radius: 100px;
}


.contenedor .productos .carta{
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0px 10px 10px 0px;
  font-size: 20px;
  color: rgb(53, 53, 53);
  text-align: start;


}

.contenedor .productos .carta p{
  background-color: #c2c2c2;
  color: #585858;

  border-radius: 100px;
  width: 20%;
  text-align: center;
  font-weight: bold;
  width: 30%;



}



</style>
