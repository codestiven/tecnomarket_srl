
<script>
import { ref } from 'vue'; // Importa ref desde Vue para crear referencias reactivas

export default {
  setup() {
    // Crea una referencia reactiva llamada datos
    const datos = ref(999);
    // Crea una referencia reactiva para manejar errores
    const error = ref(null);

    // Método para obtener datos de la API
    const fetchData = () => {
      axios.get('URL_DE_TU_API')
        .then(response => {
          datos.value = response.data; // Guarda los datos recibidos en la referencia datos
        })
        .catch(err => {
          error.value = err; // Captura errores si la solicitud falla
        });
    };

    // Llama a fetchData() cuando el componente se monta en el DOM
    fetchData();

    // Retorna los datos y métodos que deseas exponer en el componente
    return {
      datos,
      error,
    };
  },
};
</script>

<template >
    <div class="contenedor">
    <h3> {{ datos }} Productos </h3>


    <div class="contenedor productos">
    <h1> Productos</h1>
    <div class="cartas">
    
    <div class="carta"> <h1>Laptos</h1> <p>100</p> </div>
        
    <div class="carta"> <h1>Laptos</h1> <p>100</p> </div>
        
    <div class="carta"> <h1>Laptos</h1> <p>100</p> </div>
        
    <div class="carta"> <h1>Laptos</h1> <p>100</p> </div>





    </div>
    </div>
    </div>
</template>






<style >
    .contenedor{
        width: 100%;
        height: 100%;

    }
</style>